<?php

namespace sisVeterinaria;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = 'tbl_detalle_venta';
    protected $primaryKey = 'id_detalle_venta';

    public $timestamps = false;

    protected $fillable = [
        'id_producto',
        'id_venta',
        'cantidad',
        'precio_venta'
    ];

    protected $guarded = [
    	
    ];
}
