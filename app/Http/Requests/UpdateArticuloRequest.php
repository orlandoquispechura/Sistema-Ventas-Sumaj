<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticuloRequest extends FormRequest
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

            'nombre'        => 'required|regex:/^[A-Z,a-z, ,á,í,é,ó,ú,ñ,0-9]+$/|unique:articulos,nombre,' . $this->articulo . '|max:50',
            'precio_venta'  => 'required|numeric|min:0|max:10000|between:0,10000',
            'stock'         => 'numeric|required|between:0,100',
            'imagen'        => 'nullable|mimes:jpg,png,jpeg,bmp',
            'codigo'        => 'nullable|string|min:12|max:12|regex:/^[A-Z-,0-9]+$/',
            'modelo'        => 'nullable|string|min:5|max:10|regex:/^[A-Z-,0-9]+$/',
            'serie'         => 'nullable|string|unique:articulos,serie,'.$this->articulo. '|min:10|max:20|regex:/^[A-Z-,0-9]+$/',

            'marca_id' => 'integer|required|exists:App\Models\Marca,id',
            'tipo_id' => 'integer|required|exists:App\Models\TipoEquipo,id',
            'proveedor_id' => 'integer|required|exists:App\Models\Proveedor,id',
        ];
    }
    public function messages()
    {
        return [
            'nombre.regex' => 'Solo puede ingresar letras y números.',
            'precio_venta.between' => 'El precio debe estar en el rango de 0 a 10000.',
        ];
    }
}
