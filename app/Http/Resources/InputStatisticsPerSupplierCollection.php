<?php

namespace App\Http\Resources;

use App\Models\InputInvoice;
use App\Models\InputInvoiceDetail;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class InputStatisticsPerSupplierCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray ($request)
    {
        $this->collection = $this->collection->groupBy('supplier_id');
        $suppliers = collect();
        $this->collection->each(function (Collection $inputInvoices, $key) use ($suppliers)
        {
            $data = collect();
            $inputInvoices->each(function (InputInvoice $inputInvoice, $key) use ($data)
            {
                $inputInvoice->details->each(function (InputInvoiceDetail $detail, $key) use ($data)
                {

                    $category      = $detail->commodity->specification->product->category;
                    $product       = $detail->commodity->specification->product;
                    $specification = $detail->commodity->specification;

                    if ($data->doesntContain('id', $category->id))
                    {
                        $data->put($category->id,
                                   $category->getOriginal() + ['products' => [$product->id => $product->getOriginal() +
                                                                                              ['amount' => $detail->amount,
                                                                                               'total'  => $detail->price * $detail->amount]],
                                                               'amount'   => $detail->amount,
                                                               'total'    => $detail->price * $detail->amount]);
                    }
                    else
                    {
                        $categoryArr = $data->pull($category->id);

                        if (isset($categoryArr['products'][$product->id]))
                        {
                            $categoryArr['products'][$product->id]['amount'] += $detail->amount;
                            $categoryArr['products'][$product->id]['total']  += $detail->price * $detail->amount;

                        }
                        else
                        {
                            $categoryArr['products'][$product->id] = $product->getOriginal() +
                                                                     ['amount' => $detail->amount,
                                                                      'total'  => $detail->price * $detail->amount];
                        }

                        $categoryArr['amount'] += $detail->amount;
                        $categoryArr['total']  += $detail->price * $detail->amount;

                        $data->put($category->id, $categoryArr);
                    }

                });
            });
            $suppliers->push($inputInvoices->first()->supplier->getOriginal() +
                             ['categories' => $data->values(),
                              'amount'   => $data->sum('amount'),
                              'total'    => $data->sum('total')]);
        });

        return $suppliers->values();
    }
}
