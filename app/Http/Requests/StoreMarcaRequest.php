<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMarcaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre_marcas' => 'string|regex:/^[A-Z, a-z, ,á,í,é,ó,ú,ñ]+$/|required|unique:marcas|max:50'
        ];
    }
    public function messages()
    {
        return [
            'nombre_marcas.string' => 'Se necesita un nombre para la marca.',
            'nombre_marcas.regex' => 'No se permiten números ni símbolos.',
        ];
    }
}
