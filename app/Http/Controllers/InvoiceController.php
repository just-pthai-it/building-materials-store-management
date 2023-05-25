<?php

namespace App\Http\Controllers;

use App\Http\Requests\Invoice\StoreInvoicePostRequest;
use App\Models\Invoice;
use App\Services\InvoiceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    private InvoiceService $invoiceService;

    /**
     * @param InvoiceService $invoiceService
     */
    public function __construct (InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index (Request $request) : JsonResponse
    {
        return $this->invoiceService->list($request->all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreInvoicePostRequest $request
     * @return JsonResponse
     */
    public function store (StoreInvoicePostRequest $request) : JsonResponse
    {
        return $this->invoiceService->store($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param Invoice $invoice
     * @return JsonResponse
     */
    public function show (Invoice $invoice) : JsonResponse
    {
        return $this->invoiceService->get($invoice);
    }
}
