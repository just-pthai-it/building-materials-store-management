<?php

namespace App\Services;

use App\Helpers\Constants;
use App\Helpers\CusResponse;
use App\Http\Resources\InputInvoice\InputInvoiceCollection;
use App\Http\Resources\InputInvoice\InputInvoiceResource;
use App\Models\InputInvoice;
use App\Models\Specification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class InputInvoiceService
{
    public function list (array $inputs = []) : JsonResponse
    {
        $inputInvoices = InputInvoice::query()
                                     ->filter($inputs)
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

        return (new InputInvoiceCollection($inputInvoices))->response();
    }

    public function get (InputInvoice $inputInvoice) : JsonResponse
    {
        $inputInvoice->load(['user', 'supplier', 'details.commodity.specification.product',]);
        return (new InputInvoiceResource($inputInvoice))->response();
    }

    /**
     * @throws Exception
     */
    public function store (array $inputs) : JsonResponse
    {
        try
        {
            DB::beginTransaction();
            $inputInvoice = InputInvoice::query()->create($inputs);
            foreach ($inputs['details'] as $detail)
            {
                $specification = Specification::query()->find($detail['specification_id']);
                $commodity     = $specification->commodity;
                $inputInvoice->details()->create(Arr::except($detail,
                                                             ['specification_id']) + ['commodity_id' => $commodity->id]);
                $specification->current_amount = ($commodity->current_amount += $detail['amount']);
                $commodity->total_amount       += $detail['amount'];

                $commodity->save();
                $specification->save();

                $inputInvoice->total += $detail['price'] * $detail['amount'];
            }
            $inputInvoice->save();
            DB::commit();
        }
        catch (Exception $exception)
        {
            DB::rollBack();
            throw $exception;
        }

        return CusResponse::createSuccessful();
    }
}
