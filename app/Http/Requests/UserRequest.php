<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'rut'               => 'required|unique:users|numeric',
            'password'          => 'required|max:50',
            'nombre'            => 'required|max:200',
            'apellidoPaterno'   => 'required|max:150',
            'apellidoMaterno'   => 'max:150',
            'direccion'         => 'max:200',
            'correo'            => 'required|max:150|email'

        ];
    }
}
