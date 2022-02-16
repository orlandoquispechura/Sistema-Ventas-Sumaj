<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTipoEquipoRequest extends FormRequest
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
            'nombre_equipo' => 'string|regex:/^[A-Z, a-z, ,á,í,é,ó,ú,ñ]+$/|required|unique:tipo_equipos,nombre_equipo,' . $this->route('tipo')->id . '|max:50',
            'descripcion' => 'nullable|max:255'
        ];
    }
    public function messages()
    {
        return [
            'nombre_equipo.string' => 'Se necesita un nombre para la marca.',
            'nombre_equipo.regex' => 'No se permiten números ni símbolos.',
            'descripcion' => 'No puede pasar los 255 caracteres.'
        ];
    }
}
