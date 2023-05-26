<?php

namespace App\Services;

use App\Helpers\Constants;
use App\Helpers\CusResponse;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\Specification\SpecificationCollection;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductService
{
    public function list (array $inputs = []) : JsonResponse
    {
        $products = Product::query()->filter($inputs)->with(['unit'])->paginate($inputs['per_page'] ?? Constants::DEFAULT_PER_PAGE);
        return (new ProductCollection($products))->response();
    }

    public function get (Product $product) : JsonResponse
    {
        $product->load(['specifications.productTypes', 'unit']);
        return (new ProductResource($product))->response();
    }

    public function store (array $inputs) : JsonResponse
    {
        $product = Product::query()->create($inputs);
        return CusResponse::createSuccessful(['id' => $product->id]);
    }

    public function update (Product $product, array $inputs) : JsonResponse
    {
        $product->update($inputs);
        return CusResponse::successfulWithNoData();
    }

    public function delete (Product $product) : JsonResponse
    {
        $product->delete();
        return CusResponse::successfulWithNoData();
    }

    public function listSpecifications (Product $product, array $inputs = []) : JsonResponse
    {
        $specifications = $product->specifications;
        $specifications->load(['productTypes', 'product']);

        return (new SpecificationCollection($specifications))->response();
    }
}
