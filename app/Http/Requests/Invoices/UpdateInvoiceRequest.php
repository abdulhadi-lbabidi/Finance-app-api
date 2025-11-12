<?php

namespace App\Http\Requests\Invoices;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceRequest extends FormRequest
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
            'name' => 'sometimes|required|string|max:255',
            'desc' => 'nullable|string',
            'amount' => 'sometimes|required|numeric|min:1',
            'finance_item_id' => 'sometimes|required|exists:finance_items,id',
            'invoiceable_id' => 'sometimes|required|integer',
            'invoiceable_type' => 'sometimes|required|string|in:App\Models\InnerTransaction,App\Models\OuterTransaction',
        ];
    }
}
