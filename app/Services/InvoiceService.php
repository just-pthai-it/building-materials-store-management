<?php

namespace App\Services;

use App\Helpers\Constants;
use App\Helpers\CusResponse;
use App\Http\Resources\Invoice\InvoiceCollection;
use App\Http\Resources\Invoice\InvoiceResource;
use App\Models\Invoice;
use App\Models\Specification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class InvoiceService
{
    public function list (array $inputs = []) : JsonResponse
    {
        $inputInvoices = Invoice::query()->filter($inputs)
                                ->when(isset($inputs['page']),
                                    function (Builder $query) use ($inputs)
                                    {
                                        return $query->paginate($inputs['per_page'] ?? Constants::DEFAULT_PER_PAGE);
                                    },
                                    function (Builder $query)
                                    {
                                        return $query->get();
                                    }
                                );

        return (new InvoiceCollection($inputInvoices))->response();
    }

    public function get (Invoice $invoice) : JsonResponse
    {
        $invoice->load(['user', 'details.commodity.specification.product',]);
        return (new InvoiceResource($invoice))->response();
    }

    public function store (array $inputs)
    {
        try
        {
            DB::beginTransaction();
            $invoice = Invoice::query()->create($inputs);
            foreach ($inputs['details'] as $detail)
            {
                $specification = Specification::query()->find($detail['specification_id']);
                $commodity     = $specification->commodity;
                if ($detail['amount'] > $commodity->current_amount)
                {
                    abort(422, 'Không đủ số lương ' . $specification->product->name);
                }
                $invoice->details()->create(Arr::except($detail,
                                                        ['specification_id']) + ['commodity_id' => $commodity->id,
                                                                                 'price'        => $specification->price]);

                $commodity->current_amount     -= $detail['amount'];
                $specification->current_amount = ($commodity->current_amount += $detail['amount']);

                $commodity->save();
                $specification->save();

                $invoice->total += $specification->price * $detail['amount'];
            }
            $invoice->save();
            DB::commit();
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            report($exception);
            abort(500, 'Transaction exception');
        }

        return CusResponse::createSuccessful();
    }
}
