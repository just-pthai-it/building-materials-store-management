<?php

namespace App\Services;

use App\Helpers\CusResponse;
use App\Models\ProductType;
use Illuminate\Http\JsonResponse;

class ProductTypeService
{
    public function list (array $inputs = []) : JsonResponse
    {
        $productTypes = ProductType::query()->filter($inputs)->get();
        return CusResponse::successful($productTypes);
    }

    public function get (ProductType $productType) : JsonResponse
    {
        return CusResponse::successful($productType);
    }

    public function store (array $inputs) : JsonResponse
    {
        $productType = ProductType::query()->create($inputs);
        return CusResponse::createSuccessful(['id' => $productType->id]);
    }

    public function update (ProductType $productType, array $inputs) : JsonResponse
    {
        $productType->update($inputs);
        return CusResponse::successfulWithNoData();
    }

    public function delete (ProductType $productType) : JsonResponse
    {
        $productType->delete();
        return CusResponse::successfulWithNoData();
    }
}
