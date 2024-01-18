<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePokemonRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
          'name' => "string|required"
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
          'name.required' => 'O nome do Pokemon é obrigatório.'
        ];
    } 
}
