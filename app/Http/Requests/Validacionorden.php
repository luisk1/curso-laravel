<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Validacionorden extends FormRequest
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
            'orden' => 'required|integer',
            'orden_nombreproveedor' => 'required|regex:/^[\pL\s\-]+$/u'
        ];
    }
    public function messages()
    {
        return [
            'orden.required' => 'el numero de orden es obligatorio',
            'orden.integer' => 'solo se aceptan numeros',
            'orden_nombreproveedor.required' => 'el nombre de proveedor es obligatorio',
            'orden_nombreproveedor.regex' => 'solo se aceptan letras y espacios'
        ];
    }
}
