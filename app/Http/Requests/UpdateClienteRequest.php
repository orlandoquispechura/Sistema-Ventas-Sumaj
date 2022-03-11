<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
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

            'nombre' => 'required|regex:/^[A-Z,a-z, ,á,í,é,ó,ú,ñ]+$/|max:50',
            'apellido_paterno' => 'nullable|regex:/^[A-Z,a-z, ,á,í,é,ó,ú,ñ]+$/|max:50',
            'apellido_materno' => 'nullable|regex:/^[A-Z,a-z, ,á,í,é,ó,ú,ñ]+$/|max:50',
            'dni' => 'nullable|min:7|regex:/^[E,0-9,-]+$/|unique:clientes,dni,' . $this->route('cliente')->id . '|max:10',
            'direccion' => 'nullable|max:255',
            'telefono' => 'nullable|min:7|regex:/^[0-9]{7,8}$/|unique:clientes,telefono,' . $this->route('cliente')->id . '|max:8',
            'celular' => 'nullable|min:8|regex:/^[+,0-9]{8,12}$/|unique:clientes,celular,' . $this->route('cliente')->id . '|max:12',
            'email' => 'nullable|email|string|unique:clientes,email,' . $this->route('cliente')->id . '|max:100',
        ];
    }
    public function messages()
    {
        return [
            'telefono.regex' => 'No se permite texto solo números.',
            'celular.regex' => 'Solo permite el signo de adición(+).',
            'dni.regex' => 'Ingrese en mayúscula E para dni extranjero.',
        ];
    }
}
