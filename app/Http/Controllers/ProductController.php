<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductPostRequest;
use App\Http\Requests\Product\UpdateProductPatchRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductService $productService;

    /**
     * @param ProductService $productService
     */
    public function __construct (ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index (Request $request) : JsonResponse
    {
        return $this->productService->list($request->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductPostRequest $request
     * @return JsonResponse
     */
    public function store (StoreProductPostRequest $request) : JsonResponse
    {
        return $this->productService->store($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function show (Product $product) : JsonResponse
    {
        return $this->productService->get($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductPatchRequest $request
     * @param Product                   $product
     * @return JsonResponse
     */
    public function update (UpdateProductPatchRequest $request, Product $product) : JsonResponse
    {
        return $this->productService->update($product, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy (Product $product) : JsonResponse
    {
        return $this->productService->delete($product);
    }
}
