<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Invoices\CreateInvoiceRequest;
use App\Http\Requests\Invoices\UpdateInvoiceRequest;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index()
    {
        return response()->json(
            [
                'invoices' =>
                Invoice::with('financeItem')->orderByRaw('updated_at - created_at DESC')
                    ->get()
            ]
        );
    }

    public function store(CreateInvoiceRequest $request)
    {
        $data = $request->validated();

        $invoice = Invoice::create($data);

        return response()->json([
            'message' => 'Invoice created successfully',
            'invoice' => $invoice
        ], 201);
    }

    public function show(Invoice $invoice)
    {
        return response()->json(['invoice' => $invoice]);
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update($request->validated());
        return response()->json(['message' => 'Invoice updated successfully', 'invoice' => $invoice]);
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return response()->json(['message' => 'Invoice deleted successfully']);
    }
}
