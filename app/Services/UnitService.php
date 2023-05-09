<?php

namespace App\Services;

use App\Helpers\CusResponse;
use App\Models\Unit;
use Illuminate\Http\JsonResponse;

class UnitService
{
    public function list (array $inputs = []) : JsonResponse
    {
        $units = Unit::query()->filter($inputs)->get();
        return CusResponse::successful($units);
    }

    public function get (Unit $unit) : JsonResponse
    {
        return CusResponse::successful($unit);
    }

    public function store (array $inputs) : JsonResponse
    {
        $unit = Unit::query()->create($inputs);
        return CusResponse::createSuccessful(['id' => $unit->id]);
    }

    public function update (Unit $unit, array $inputs) : JsonResponse
    {
        $unit->update($inputs);
        return CusResponse::successfulWithNoData();
    }

    public function delete (Unit $unit) : JsonResponse
    {
        $unit->delete();
        return CusResponse::successfulWithNoData();
    }
}
