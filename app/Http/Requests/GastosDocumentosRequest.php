<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GastosDocumentosRequest extends FormRequest
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
            'codigo'        => 'required|max:10|unique:documentos',
            'nombre'        => 'required|max:100',
            'descripcion'   => 'required'
        ];
    }
}
