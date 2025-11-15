<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Invoices\CreateInvoiceRequest;
use App\Http\Requests\Invoices\UpdateInvoiceRequest;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type');
        $query = Invoice::with('financeitem:id,name')->orderBy('updated_at', 'desc');

        if ($type) {
            $query->where('invoiceable_type', "App\\Models\\" . ucfirst($type));
        }
        $invoices = $query->get();
        return response()->json(['invoices' => $invoices]);
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
