<?php

namespace sisVeterinaria\Http\Requests;

use sisVeterinaria\Http\Requests\Request;

class VentaRequest extends Request
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
            'id_cliente' => 'required',
            'tipo_comprobante' => 'required|max:15',
            'serie' => 'max:5',
            'numero_comprobante' => 'required',
            'id_producto' => 'required',
            'cantidad' => 'required',
            'precio_venta' => 'required',
            'total_venta' => 'required'
        ];
    }
}
