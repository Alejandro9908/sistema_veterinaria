<?php

namespace sisVeterinaria\Http\Requests;

use sisVeterinaria\Http\Requests\Request;

class CompraRequest extends Request
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
            'id_proveedor' => 'required',
            'tipo_comprobante' => 'required|max:15',
            'serie' => 'max:5',
            'numero_comprobante' => 'required',
            'id_producto' => 'required',
            'cantidad' => 'required|numeric',
            'precio_compra' => 'required|numeric',
            'precio_venta' => 'required|numeric'
        ];
    }
}
