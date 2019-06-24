<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrevisionRequest extends FormRequest
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
            'nombre'              => 'required|max:100|unique:salud',
            'porcentajeDescuento' => 'required|numeric|Min:0|Max:99'
        ];
    }
}
