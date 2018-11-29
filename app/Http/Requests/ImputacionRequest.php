<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImputacionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'establecimiento' => 'required',            
            'subvencion'      => 'required',            
            'cuenta'          => 'required',            
            'tipoDocumento'   => 'required',
            'formaPago'       => 'required',
            'numDocumento'    => 'required|Integer|min:0|max:99999999999',
            'fechaDocumento'  => 'required',
            'fechaPago'       => 'required',
            'descripcion'     => 'required',
            'proveedor'       => 'required',
            'montoGasto'      => 'required|Integer|min:0|max:999999',
            'montoDocumento'  => 'required|Integer|min:0|max:999999',           
            'estado'          => 'required'


        ];      
    }
}
