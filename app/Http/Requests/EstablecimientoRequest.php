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
            'rbd'             => 'required|unique:establecimientos',
            'nombre'          => 'required|max:200',
            'razonSocial'     => 'required|max:150',
            'rut'             => 'required|unique:establecimientos',
            'tipoDependencia' => 'required',
            'sostenedor'      => 'required',
            'comuna'          => 'required',
            'direccion'       => 'required|max:250',
            'fono'            => 'required|numeric|max:9999999999',
            'correo'          => 'max:150|email'
        ];
    }
}
