<?php

namespace sisVeterinaria;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'tbl_cliente';
    protected $primaryKey = 'id_cliente';

    public $timestamps = false;

    protected $fillable = [  
        'dpi',
        'nombres',
        'apellidos', 
        'telefono',
        'correo',
        'direccion',
        'estado',
        'fecha_commit',
        'id_usuario'
    ];

    protected $guarded = [
    	
    ];
}
