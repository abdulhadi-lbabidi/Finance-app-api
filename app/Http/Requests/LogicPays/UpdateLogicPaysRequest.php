<?php

namespace App\Http\Requests\LogicPays;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLogicPaysRequest extends FormRequest
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
            'name' => 'sometimes|string|max:255',
            'desc' => 'sometimes|nullable|string',
            'amount' => 'sometimes|numeric|min:1',
            'price' => 'sometimes|numeric|min:1',
            'payed' => 'sometimes|boolean',
            'workshopname' => 'sometimes|nullable|string|max:255',
            'logistic_team_id' => 'sometimes|exists:logistic_teams,id',
            'invoice_id' => 'sometimes|exists:invoices,id',
        ];
    }
}
