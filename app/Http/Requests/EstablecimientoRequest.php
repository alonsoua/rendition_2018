<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstablecimientoRequest extends FormRequest
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
            'nombre'            => 'required|max:200|unique:establecimientos',
            'rbd'               => 'required|max:20',
            'razonSocial'       => 'required|max:150',
            'rut'               => 'required|numeric|unique:establecimientos',
            'tipoDependencia'   => 'required',
            'sostenedor'        => 'required',
            'comuna'            => 'required',
            'direccion'         => 'required|max:250',
            'fono'              => 'required|max:45',
            'correo'            => 'max:150|email'
        ];
    }
}
