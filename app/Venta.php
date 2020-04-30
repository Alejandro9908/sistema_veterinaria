<?php

namespace sisVeterinaria;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'tbl_venta';
    protected $primaryKey = 'id_venta';

    public $timestamps = false;

    protected $fillable = [
    	'id_cliente',
        'tipo_comprobante',
        'serie',
        'numero_comprobante',
        'total_venta',
        'estado',
        'fecha_commit',
        'id_usuario'
    ];

    protected $guarded = [
    	
    ];
}
