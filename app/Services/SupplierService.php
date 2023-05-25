<?php

namespace App\Services;

use App\Helpers\CusResponse;
use App\Http\Resources\Supplier\SupplierCollection;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;

class SupplierService
{
    public function list (array $inputs = []) : JsonResponse
    {
        $suppliers = Supplier::query()->filter($inputs)->paginate($inputs['per_page'] ?? 10);
        return (new SupplierCollection($suppliers))->response();
    }

    public function get (Supplier $supplier) : JsonResponse
    {
        return CusResponse::successful($supplier);
    }

    public function store (array $inputs) : JsonResponse
    {
        $supplier = Supplier::query()->create($inputs);
        return CusResponse::createSuccessful($supplier);
    }

    public function update (Supplier $supplier, array $inputs) : JsonResponse
    {
        $supplier->update($inputs);
        return CusResponse::successful();
    }

    public function delete (Supplier $supplier) : JsonResponse
    {
        $supplier->delete();
        return CusResponse::successfulWithNoData();
    }
}
