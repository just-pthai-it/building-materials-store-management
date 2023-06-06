<?php

namespace App\Services;

use App\Http\Resources\InputStatisticsCollection;
use App\Http\Resources\OutputStatisticsCollection;
use App\Models\InputInvoice;
use App\Models\Invoice;

class StatisticsService
{
    public function input (array $inputs)
    {
        $inputInvoices = InputInvoice::query()->with('details.commodity.specification.product.category')->get();
//        return response()->json($inputInvoices);
        return (new InputStatisticsCollection($inputInvoices))->response();
    }

    public function output (array $inputs)
    {
        $invoice = Invoice::query()->with('details.commodity.specification.product.category')->get();
//        return $inputInvoices;
        return (new OutputStatisticsCollection($invoice))->response();
    }
}
