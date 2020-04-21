<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Validacionusuario extends FormRequest
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
            'usua_datos.nombre' => 'required|max:50|alpha',
            'usua_datos.apellido' => 'required|max:50|alpha',
            'cedula' => 'required|integer',
            'usua_datos.email' => 'required|email|max:50',
            'password' => 'required',          
            
               ];
    }
    public function messages()
    {
        return [
            'usua_datos.nombre.required' => 'el nombre es obligatorio',
            'usua_datos.nombre.alpha' => 'solo se aceptan letras no numeros',
            'usua_datos.apellido.required' => 'el apellido es obligatorio',
            'usua_datos.apellido.alpha' => 'solo se aceptan letras no numeros',
            'cedula.required' => 'el numero de cedula es obligatorio',
            'cedula.integer' => 'solo se permiten numeros',
            'usua_datos.email.required' => 'el email es obligatiorio',
            'usua_datos.email.email' => 'email no coincide con verificacion',
            'password.required' => 'la contraseña es obligatoria'
        ];
    }
}
