<?php

namespace App\Http\Requests\MonyTransfer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMonyTransferRequest extends FormRequest
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
      'desc' => 'nullable|string',
      'amount' => 'sometimes|numeric|min:1',
      'from_tresure_fund_id' => 'sometimes|exists:tresure_funds,id',
      'to_tresure_fund_id' => 'sometimes|exists:tresure_funds,id|different:from_treasure_fund_id',
    ];
  }
}
