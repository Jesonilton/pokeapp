<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePokemonRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
      return [
        'name' => "string|required",
        'avatar' => "string|required",
        'weight' => "numeric|required|max:999.99",
        'height' => "numeric|required|max:999.99",
        'types' => "integer|required",
      ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
      return [
        'name.required' => 'Pokemon Name cannot be empty.',
        'avatar.required' => 'Pokemon Avatar cannot be empty.',
        'weight.numeric' => 'Pokemon Weight must be a number.',
        'weight.required' => 'Pokemon Weight cannot be empty.',
        'height.numeric' => 'Pokemon Height must be a number.',
        'height.required' => 'Pokemon Height cannot be empty.',
        'types.integer' => 'Pokemon Types must be an integer number.',
        'types.required' => 'Pokemon Types cannot be empty.',
      ];
    } 
}
