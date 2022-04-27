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
    public function rules()
    {
        return [
            'nombre'        => 'required|regex:/^[A-Z,a-z, ,á,í,é,ó,ú,ñ,0-9]+$/|unique:articulos,nombre,' . $this->articulo . '|max:50',
            'precio_venta'  => 'required|numeric|min:0|max:50000|between:0,50000',
            'stock'         => 'numeric|required|between:0,100',
            'codigo'        => 'nullable|string|min:5|max:15|regex:/^[A-Z-,0-9]+$/|unique:articulos,codigo,' . $this->articulo,
            'modelo'        => 'nullable|string|min:5|max:12|regex:/^[A-Z-,0-9]+$/|unique:articulos,modelo,' . $this->articulo,
           

            'marca_id' => 'integer|required|exists:App\Models\Marca,id',
            'tipo_id' => 'integer|required|exists:App\Models\TipoEquipo,id',
            'proveedor_id' => 'integer|required|exists:App\Models\Proveedor,id',
        ];
    }
    public function messages()
    {
        return [
            'nombre.regex' => 'Solo puede ingresar letras y números.',
            'precio_venta.between' => 'El precio debe estar en el rango de 0 a 50000.',
            
            'modelo.regex' => 'Ingrese solo letras mayúsculas.',
        ];
    }
}
