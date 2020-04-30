<?php

namespace sisVeterinaria;

use Illuminate\Database\Eloquent\Model;

class VentaServicio extends Model
{
    protected $table = 'tbl_venta_servicio';
    protected $primaryKey = 'id_venta_servicio';

    public $timestamps = false;

    protected $fillable = [
        'tipo_comprobante',
        'serie',
        'numero_comprobante',
        'total_venta_servicio',
        'estado',
        'fecha_commit',
        'id_usuario',
        'id_mascota'
    ];

    protected $guarded = [
    	
    ];
}
