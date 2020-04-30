<?php

namespace sisVeterinaria;

use Illuminate\Database\Eloquent\Model;

class DetalleVentaServicio extends Model
{
    protected $table = 'tbl_detalle_venta_servicio';
    protected $primaryKey = 'id_detalle_venta_servicio';

    public $timestamps = false;

    protected $fillable = [
    	'id_servicio',
        'id_venta_servicio',
        'fecha_programada',
        'estado',
        'cantidad',
        'precio_venta'
    ];

    protected $guarded = [
    	
    ];
}
