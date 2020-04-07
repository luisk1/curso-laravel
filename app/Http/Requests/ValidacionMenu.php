<?php

namespace App\Http\Requests;

use App\Rules\ValidarCampoUrl;
use Illuminate\Foundation\Http\FormRequest;

class ValidacionMenu extends FormRequest
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
            'menu_nombre' => 'required|max:50|unique:menu,menu_nombre,' . $this->route('id'),
            'menu_url' => ['required','max:50', new ValidarCampoUrl],
            'menu_icono' => 'nullable|max:50'
        ];
    }
   
}
