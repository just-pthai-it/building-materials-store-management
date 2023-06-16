<?php

namespace App\Http\Controllers;

use App\Services\StatisticsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    private StatisticsService $statisticsService;

    /**
     * @param StatisticsService $statisticsService
     */
    public function __construct (StatisticsService $statisticsService)
    {
        $this->statisticsService = $statisticsService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function input (Request $request) : JsonResponse
    {
        return $this->statisticsService->input($request->all());
    }

    public function inputPerSupplier (Request $request) : JsonResponse
    {
        return $this->statisticsService->inputPerSupplier($request->all());

    }

    public function output (Request $request) : JsonResponse
    {
        return $this->statisticsService->output($request->all());
    }
}
