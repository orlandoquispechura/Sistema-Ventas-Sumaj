<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticuloRequest extends FormRequest
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
            'nombre' => 'required|regex:/^[A-Z,a-z, ,á,í,é,ó,ú,ñ,0-9]+$/|unique:articulos|max:50',
            'precio_venta' => 'required|numeric|min:0|max:50000|between:0,50000',
            'codigo' => 'nullable|string|min:5|max:15|regex:/^[A-Z-,0-9]+$/|unique:articulos',
            'modelo' => 'nullable|string|min:5|max:12|regex:/^[A-Z-,0-9]+$/|unique:articulos',
            
        ];
    }
    public function messages()
    {
        return [
            'nombre.regex' => 'Solo puede ingresar letras y números.',
            'precio_venta.between' => 'El precio debe estar en el rango de 0 a 50000.',
            'codigo.regex' => 'No se permite letra minúscula.',
            
            'modelo.regex' => 'Ingrese solo letras mayúsculas.',
        ];
    }
}
