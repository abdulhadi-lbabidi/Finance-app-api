<?php

namespace App\Http\Requests\InvoiceItems;

use Illuminate\Foundation\Http\FormRequest;

class CreateInvoiceItemRequest extends FormRequest
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
            'price' => 'required|numeric|min:1',
            'payed' => 'required|boolean',
            'invoice_id' => 'required|exists:invoices,id',
        ];
    }
}
