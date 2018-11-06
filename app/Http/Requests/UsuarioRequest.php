<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
            'rut'       => 'required|unique:usuarios|numeric',
            'pass'      => 'required|max:50',
            'nombre'    => 'required|max:60',
            'direccion' => 'max:200',
            'correo'    => 'required|max:150|email'
        ];
    }
}
