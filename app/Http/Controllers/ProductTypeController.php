<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductType\StoreProductTypePostRequest;
use App\Http\Requests\ProductType\UpdateProductTypePatchRequest;
use App\Models\ProductType;
use App\Services\ProductTypeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    private ProductTypeService $productTypeService;

    /**
     * @param ProductTypeService $productTypeService
     */
    public function __construct (ProductTypeService $productTypeService)
    {
        $this->productTypeService = $productTypeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index (Request $request) : JsonResponse
    {
        return $this->productTypeService->list($request->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductTypePostRequest $request
     * @return JsonResponse
     */
    public function store (StoreProductTypePostRequest $request) : JsonResponse
    {
        return $this->productTypeService->store($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param ProductType $productType
     * @return JsonResponse
     */
    public function show (ProductType $productType) : JsonResponse
    {
        return $this->productTypeService->get($productType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductTypePatchRequest $request
     * @param ProductType                   $productType
     * @return JsonResponse
     */
    public function update (UpdateProductTypePatchRequest $request, ProductType $productType) : JsonResponse
    {
        return $this->productTypeService->update($productType, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductType $productType
     * @return JsonResponse
     */
    public function destroy (ProductType $productType) : JsonResponse
    {
        return $this->productTypeService->delete($productType);
    }
}
