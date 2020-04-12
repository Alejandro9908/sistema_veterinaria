<?php

namespace sisVeterinaria\Http\Requests;

use sisVeterinaria\Http\Requests\Request;

class ProveedorRequest extends Request
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
            'nit' => 'required|max:15',
            'razon_social' => 'required|max:50',
            'descripcion' => 'max:250',
            'telefono' => 'required|max:15',
            'correo' => 'max:50',
            'pagina_web' => 'max:50',
            'direccion' => 'max:150'
        ];
    }
}
