<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Majuscules;

class GuardarCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        // Falta afegir sa regla de Majuscules
        return [
            'title' => ['required','unique:categories','min:5','max:255'],
            'url_clean' => ['required','unique:categories','min:5','max:255'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => "Has d'informar un títol",
            'title.unique' => "Aquest títol ja existeix",
            'title.min' => "Mínim de 5 caracters",
            'title.max' => "Màxim de 255 caracters",
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Títol',
        ];
    }
}
