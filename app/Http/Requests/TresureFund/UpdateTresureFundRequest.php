<?php

namespace App\Http\Requests\TresureFund;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTresureFundRequest extends FormRequest
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
      'tresure_id' => 'sometimes|required|exists:tresures,id',
    ];
  }
}
