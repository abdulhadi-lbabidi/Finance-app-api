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
        $invoiceItems = InvoiceItem::orderBy('updated_at', 'desc')
            ->get();

        $beforeDiscount = $invoiceItems->sum(function ($item) {
            return $item->amount * $item->price;
        });
        $afterDiscount = $invoiceItems->sum('finalprice');

        return response()->json([
            'invoiceItems' => $invoiceItems,
            'before_discount' => $beforeDiscount,
            'after_discount'  => $afterDiscount,
        ]);
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
