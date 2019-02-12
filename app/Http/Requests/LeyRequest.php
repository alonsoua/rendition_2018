<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeyRequest extends FormRequest
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
            'codigo'           => 'required|max:20',
            'nombre'           => 'required|max:100',
            'tipo'             => 'required',
            'subvencion'       => 'required',
            'descripcion'      => 'required',
            'porcentajeMáximo' => 'required|Integer|min:0|max:999',
            'tope'             => 'required|Integer|min:0|max:99999999'
        ];
    }
}
