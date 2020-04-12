<?php

namespace sisVeterinaria\Http\Requests;

use sisVeterinaria\Http\Requests\Request;

class ProductoRequest extends Request
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
            'codigo' => 'max:50',
            'nombre' => 'required|max:50',
            'id_categoria'=> 'required',
            'descripcion' => 'max:250',
            'precio_venta' => 'required|numeric',
            'stock' => 'required|numeric',
            'imagen' => 'mimes:jpeg,bmp,png',
        ];
    }
}
