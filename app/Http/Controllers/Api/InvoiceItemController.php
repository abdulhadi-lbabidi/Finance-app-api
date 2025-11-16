<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceItems\CreateInvoiceItemRequest;
use App\Http\Requests\InvoiceItems\UpdateInvoiceItemRequest;
use App\Models\InvoiceItem;

class InvoiceItemController extends Controller
{
    public function index()
    {
        return response()->json(
            [
                'invoiceItems' => InvoiceItem::orderBy('updated_at', 'desc')->get()
            ]
        );
    }
    public function store(CreateInvoiceItemRequest $request)
    {
        $data = $request->validated();

        $invoiceItem  = InvoiceItem::create($data);

        return response()->json([
            'message' => 'invoiceItem created successfully',
            'invoiceItem' => $invoiceItem
        ], 201);
    }
    public function show(InvoiceItem $invoiceItem)
    {
        return response()->json(['invoiceItem' => $invoiceItem]);
    }
    public function update(UpdateInvoiceItemRequest $request, InvoiceItem $invoiceItem)
    {
        $invoiceItem->update($request->validated());
        return response()->json(['message' => 'invoiceItem updated successfully', 'invoiceItem' => $invoiceItem]);
    }
    public function destroy(InvoiceItem $invoiceItem)
    {
        $invoiceItem->delete();
        return response()->json(['message' => 'invoiceItem deleted successfully']);
    }
}
