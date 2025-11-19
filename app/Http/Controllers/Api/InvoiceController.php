<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Invoices\CreateInvoiceRequest;
use App\Http\Requests\Invoices\UpdateInvoiceRequest;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type');

        $query = Invoice::with('financeitem:id,name')
            ->orderBy('updated_at', 'desc');

        if ($type) {
            $query->where('invoiceable_type', lcfirst($type));
        }

        $beforeDiscount = (clone $query)->sum('amount');
        $afterDiscount  = (clone $query)->sum('final_price');

        $invoices = $query->get();

        return response()->json([
            'invoices' => $invoices,
            'totals' => [
                'before_discount' => $beforeDiscount,
                'after_discount' => $afterDiscount,
            ],
        ]);
    }



    public function store(CreateInvoiceRequest $request)
    {
        $data = $request->validated();

        $amount = $data['amount'];
        $discountValue = $data['discount_value'] ?? 0;
        $discountType = $data['discount_type'] ?? 'amount';

        if ($discountType === 'نسبة') {
            $discount = $amount * ($discountValue / 100);
        } else {
            $discount = $discountValue;
        }

        $data['final_price'] = $amount - $discount;

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
        $data = $request->validated();

        $amount = $data['amount'] ?? $invoice->amount;
        $discountValue = $data['discount_value'] ?? $invoice->discount_value;
        $discountType = $data['discount_type'] ?? $invoice->discount_type;

        if ($discountType === 'نسبة') {
            $discount = $amount * ($discountValue / 100);
        } else {
            $discount = $discountValue;
        }
        $finalPrice = $amount - $discount;

        $data['final_price'] = $finalPrice;
        $invoice->update($data);
        return response()->json([
            'message' => 'Invoice updated successfully',
            'invoice' => $invoice
        ]);
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return response()->json(['message' => 'Invoice deleted successfully']);
    }

    public function storeInvoiceImage(Request $request, Invoice $invoice)
    {
        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png,webp,pdf',
        ]);
        if ($path = $request->file('image')?->storePublicly('invoices', 'public')) {
            $invoice->images()->create(['url' => $path]);
        }
        return response()->json([
            'message' => 'Image uploaded successfully',
            'path' => asset('storage/' . $path),
        ]);
    }
    public function getAllInvoicesImages($type)
    {
        $invoices = Image::where(
            'imageable_type',
            lcfirst($type)
        )->get();
        return response()->json(['invoices' => $invoices]);
    }

    public function showInvoiceImage(Image $image)
    {
        return response()->json(['image' => $image]);
    }

    public function deleteInvoiceImage(Image $image)
    {
        $filePath = str_replace(asset('storage') . '/', '', $image->url);

        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        $image->delete();

        return response()->json(['message' => 'Image deleted successfully']);
    }


    public function downloadInvoiceImage(Image $image)
    {

        $path = storage_path("app/public/" . $image->url);

        if (!file_exists($path)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        return response()->download($path);
    }
}
