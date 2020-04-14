<?php

namespace sisVeterinaria;

use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    protected $table = 'tbl_detalle_compra';
    protected $primaryKey = 'id_detalle_compra';

    public $timestamps = false;

    protected $fillable = [
    	'id_compra',
        'id_producto',
        'cantidad',
        'precio_compra',
        'precio_venta'
    ];

    protected $guarded = [
    	
    ];
}
