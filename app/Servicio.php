<?php

namespace sisVeterinaria;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'tbl_servicio';
    protected $primaryKey = 'id_servicio';

    public $timestamps = false;

    protected $fillable = [ 
        'nombre_servicio', 
        'descripcion', 
        'estado', 
        'precio_servicio',  
        'fecha_commit', 
        'id_usuario'
    ];

    protected $guarded = [
    	
    ];
}
