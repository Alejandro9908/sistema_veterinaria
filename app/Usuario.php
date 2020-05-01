<?php

namespace sisVeterinaria;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use sisVeterinaria\Http\Middleware\Authenticate;

class Usuario extends Authenticatable
{
	
   //Declaramos a que tabla hará referencia
   protected $table = 'tbl_usuario';
   protected $primaryKey = 'id_usuario';
   public $timestamps=false; //no necesito que se agreguen las columnas de creacion y actualizacion de registro
   
   protected $fillable = [

   	'dpi',
   	'nombres',
   	'apellidos',
   	'fecha_nacimiento',
   	'fecha_inicio',
   	'telefono',
   	'email',
   	'direccion',
   	'cargo',
   	'permisos',
   	'estado',
   	'nick',
   	'password',
   	'fecha_commit'
   ];
   /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
//No queremos que se asignen al modelo
   protected $guarded = [

   ];

}
