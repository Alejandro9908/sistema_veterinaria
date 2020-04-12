<?php

namespace sisVeterinaria;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'tbl_proveedor';
    protected $primaryKey = 'id_proveedor';

    public $timestamps = false;

    protected $fillable = [  
        'nit',
        'razon_social',
        'descripcion', 
        'telefono',
        'correo',
        'pagina_web',
        'direccion',
        'estado',
        'fecha_commit',
        'id_usuario'
    ];

    protected $guarded = [
    	
    ];
}
