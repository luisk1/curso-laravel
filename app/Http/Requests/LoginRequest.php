<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'usua_datos' => 'required',
            'password' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'usua_datos.required' => 'usuario es obligatorio',
            'password.required' => 'contraseña es obligatoria'
        ];
    }
}
