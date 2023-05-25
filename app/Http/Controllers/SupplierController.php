<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supplier\StoreSupplierPostRequest;
use App\Http\Requests\Supplier\UpdateSupplierPatchRequest;
use App\Models\Supplier;
use App\Services\SupplierService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    private SupplierService $supplierService;

    /**
     * @param SupplierService $supplierService
     */
    public function __construct (SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index (Request $request) : JsonResponse
    {
        return $this->supplierService->list($request->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSupplierPostRequest $request
     * @return JsonResponse
     */
    public function store (StoreSupplierPostRequest $request) : JsonResponse
    {
        return $this->supplierService->store($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param Supplier $supplier
     * @return JsonResponse
     */
    public function show (Supplier $supplier) : JsonResponse
    {
        return $this->supplierService->get($supplier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSupplierPatchRequest $request
     * @param Supplier                   $supplier
     * @return JsonResponse
     */
    public function update (UpdateSupplierPatchRequest $request, Supplier $supplier) : JsonResponse
    {
        return $this->supplierService->update($supplier, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Supplier $supplier
     * @return JsonResponse
     */
    public function destroy (Supplier $supplier) : JsonResponse
    {
        return $this->supplierService->delete($supplier);
    }
}
