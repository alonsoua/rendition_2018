<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GastosProveedoresRequest extends FormRequest
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
            'tipoPersona'   => 'required',
            'rut'           => 'required|unique:proveedors',
            'razonSocial'   => 'required|max:100',
            'giro'          => 'max:45',
            'comuna'        => 'required',
            'direccion'     => 'required|max:250',
            'telefono'      => 'required|numeric|max:9999999999',
            'correo'        => 'max:150|email|min:0'
        ];
    }
}
