<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarTagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required','unique:tags','min:3','max:255'],
        ];
    }

    
    public function messages()
    {
        return [
            'name.required' => "Has d'informar un nom",
            'name.unique' => "Aquesta etiqueta ja existeix",
            'name.min' => "Mínim de 3 caracters",
            'name.max' => "Màxim de 255 caracters",
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nom',
        ];
    }
}
