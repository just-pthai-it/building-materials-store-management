<?php

namespace App\Http\Controllers;

use App\Http\Requests\InputInvoice\StoreInputInvoicePostRequest;
use App\Models\InputInvoice;
use App\Services\InputInvoiceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class InputInvoiceController extends Controller
{
    private InputInvoiceService $inputInvoiceService;

    /**
     * @param InputInvoiceService $inputInvoiceService
     */
    public function __construct (InputInvoiceService $inputInvoiceService)
    {
        $this->inputInvoiceService = $inputInvoiceService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index (Request $request) : JsonResponse
    {
        return $this->inputInvoiceService->list($request->all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreInputInvoicePostRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store (StoreInputInvoicePostRequest $request) : JsonResponse
    {
        return $this->inputInvoiceService->store($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param InputInvoice $inputInvoice
     * @return JsonResponse
     */
    public function show (InputInvoice $inputInvoice) : JsonResponse
    {
        return $this->inputInvoiceService->get($inputInvoice);
    }
}
