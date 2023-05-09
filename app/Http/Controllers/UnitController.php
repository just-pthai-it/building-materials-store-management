<?php

namespace App\Http\Controllers;

use App\Http\Requests\Unit\StoreUnitPostRequest;
use App\Http\Requests\Unit\UpdateUnitPatchRequest;
use App\Models\Unit;
use App\Services\UnitService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    private UnitService $unitService;

    /**
     * @param UnitService $unitService
     */
    public function __construct (UnitService $unitService)
    {
        $this->unitService = $unitService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index (Request $request) : JsonResponse
    {
        return $this->unitService->list($request->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUnitPostRequest $request
     * @return JsonResponse
     */
    public function store (StoreUnitPostRequest $request) : JsonResponse
    {
        return $this->unitService->store($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param Unit $unit
     * @return JsonResponse
     */
    public function show (Unit $unit) : JsonResponse
    {
        return $this->unitService->get($unit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUnitPatchRequest $request
     * @param Unit                   $unit
     * @return JsonResponse
     */
    public function update (UpdateUnitPatchRequest $request, Unit $unit) : JsonResponse
    {
        return $this->unitService->update($unit, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Unit $unit
     * @return JsonResponse
     */
    public function destroy (Unit $unit) : JsonResponse
    {
        return $this->unitService->delete($unit);
    }
}
