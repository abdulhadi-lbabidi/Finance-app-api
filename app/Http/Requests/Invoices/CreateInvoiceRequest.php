<?php

namespace App\Http\Requests\Invoices;

use Illuminate\Foundation\Http\FormRequest;

class CreateInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'amount' => 'required|numeric|min:1',
            'finance_item_id' => 'required|exists:finance_items,id',
            'invoiceable_id' => 'required|integer',
            'invoiceable_type' => 'required|string|in:App\Models\InnerTransaction,App\Models\OuterTransaction',
        ];
    }
}
