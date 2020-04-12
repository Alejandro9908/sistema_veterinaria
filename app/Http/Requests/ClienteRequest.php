<?php

namespace sisVeterinaria\Http\Requests;

use sisVeterinaria\Http\Requests\Request;

class ClienteRequest extends Request
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
            'dpi' => 'max:50',
            'nombres' => 'required|max:50',
            'apellidos' => 'required|max:50',
            'telefono' => 'required|max:15',
            'correo' => 'max:50',
            'direccion' => 'max:150'
        ];
    }
}
