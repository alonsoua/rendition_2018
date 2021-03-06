<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SostenedorRequest extends FormRequest
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
            'rut'             => 'required|unique:sostenedors',
            'nombre'          => 'required|max:60',
            'apellidoPaterno' => 'required|max:150',
            'apellidoMaterno' => 'required|max:150',            
            'comuna'          => 'required',
            'direccion'       => 'max:250|required',
            'fono'            => 'numeric|max:9999999999',
            'correo'          => 'max:150|email|min:0'
        ];
    }
}
