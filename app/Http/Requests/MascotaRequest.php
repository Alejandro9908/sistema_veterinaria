<?php

namespace sisVeterinaria\Http\Requests;

use sisVeterinaria\Http\Requests\Request;

class MascotaRequest extends Request
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
            'nombre_mascota' => 'required|max:50',
            'pedigri' => 'max:50',
            'raza' => 'required|max:50',
            'sexo' => 'required|max:10',
            'color_primario' => 'required|max:20',
            'color_secundario' => 'max:20',
            'observacion' => 'max:250',
            'especie' => 'required|max:50',
        ];
    }
}
