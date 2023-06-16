<?php

namespace App\Services;

use App\Http\Resources\InputStatisticsCollection;
use App\Http\Resources\InputStatisticsPerSupplierCollection;
use App\Http\Resources\OutputStatisticsCollection;
use App\Models\InputInvoice;
use App\Models\Invoice;
use Illuminate\Http\JsonResponse;

class StatisticsService
{
    public function input (array $inputs) : JsonResponse
    {
        $inputInvoices = InputInvoice::query()->filter($inputs)->with('details.commodity.specification.product.category')->get();
        return (new InputStatisticsCollection($inputInvoices))->response();
    }

    public function inputPerSupplier (array $inputs) : JsonResponse
    {
        $inputInvoices = InputInvoice::query()->filter($inputs)->with(['supplier', 'details.commodity.specification.product.category'])->get();
        return (new InputStatisticsPerSupplierCollection($inputInvoices))->response();
    }

    public function output (array $inputs) : JsonResponse
    {
        $invoice = Invoice::query()->filter($inputs)->with('details.commodity.specification.product.category')->get();
        return (new OutputStatisticsCollection($invoice))->response();
    }
}
