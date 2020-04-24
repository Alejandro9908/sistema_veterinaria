<?php

namespace sisVeterinaria;

use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    protected $table = 'tbl_mascota';
    protected $primaryKey = 'id_mascota';

    public $timestamps = false;

    protected $fillable = [
    	'id_cliente',
        'nombre_mascota',
        'pedigri',
        'raza',
        'sexo',
        'color_primario',
        'color_secundario',
        'fecha_nacimiento',
        'observacion',
        'fecha_primer_ingreso',
        'estado',
        'fecha_commit',
        'id_usuario',
        'especie'
    ];

    protected $guarded = [
    	
    ];
}
