<?php

namespace sisVeterinaria;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'tbl_compra';
    protected $primaryKey = 'id_compra';

    public $timestamps = false;

    protected $fillable = [
    	'id_proveedor',
        'tipo_comprobante',
        'serie',
        'numero_comprobante',
        'total_compra',
        'estado',
        'fecha_commit',
        'id_usuario'
    ];

    protected $guarded = [
    	
    ];
}
