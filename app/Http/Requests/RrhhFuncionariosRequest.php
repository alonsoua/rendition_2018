<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RrhhFuncionariosRequest extends FormRequest
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
            'establecimiento'       => 'required',
            'rut'                   => 'required|unique:funcionarios',
            'nombre'                => 'required|max:100',
            'apellidoPaterno'       => 'required|max:50',
            'apellidoMaterno'       => 'required|max:50',
            'afp'                   => 'required',
            'salud'                 => 'required',            
            'tipoContrato'          => 'required',
            'horasCtoSemanal'       => 'required|max:44',
            'fechaInicioContrato'   => 'required',
            'fechaTerminoContrato'  => 'required',
            'funcion'               => 'required'
        ];
    }
}
