<?php

namespace App\Http\Requests\Tresure;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTresureRequest extends FormRequest
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
      'active' => 'sometimes|boolean',
      'tresureable_id' => 'sometimes|integer',
      'tresureable_type' => 'required|string|in:admin,customer,workshop,employee,office,deposit',
    ];
  }
}