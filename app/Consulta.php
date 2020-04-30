<?php

namespace sisVeterinaria;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $table = 'tbl_consulta';
    protected $primaryKey = 'id_consulta';

    public $timestamps = false;

    protected $fillable = [
        'id_mascota',
        'sintomas',
        'diagnostico',
        'precio_consulta',
        'fecha_programada',
        'estado',
        'fecha_commit',
        'id_usuario',
        'tipo_comprobante',
        'serie',
        'numero_comprobante'
    ];

    protected $guarded = [
    	
    ];
}
