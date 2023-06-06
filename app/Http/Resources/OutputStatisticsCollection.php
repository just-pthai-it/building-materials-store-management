<?php

namespace App\Http\Resources;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OutputStatisticsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray ($request)
    {
        $data = collect([]);
        $this->collection->each(function (Invoice $inputInvoice, $key) use ($data)
        {
            $inputInvoice->details->each(function (InvoiceDetail $detail, $key) use ($data)
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
                        $categoryArr['products'][$product->id] = [$product->getOriginal() +
                                                                  ['amount' => $detail->amount,
                                                                   'total'  => $detail->price * $detail->amount]];
                    }

                    $categoryArr['amount'] += $detail->amount;
                    $categoryArr['total']  += $detail->price * $detail->amount;

                    $data->put($category->id, $categoryArr);
                }

            });
        });

        return $data;
    }
}
