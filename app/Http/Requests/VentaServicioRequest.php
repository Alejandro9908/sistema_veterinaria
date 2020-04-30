<?php

namespace sisVeterinaria\Http\Requests;

use sisVeterinaria\Http\Requests\Request;

class VentaServicioRequest extends Request
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
            'id_mascota' => 'required',
            'tipo_comprobante' => 'max:15',
            'serie' => 'max:5',
            'id_tipo_servicio' => 'required',
            'fecha_programada' => 'required',
            'precio_venta' => 'required'
        ];
    }
}
