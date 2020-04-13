<?php

namespace sisVeterinaria;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
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
   	'correo',
   	'direccion',
   	'cargo',
   	'permisos',
   	'estado',
   	'nick',
   	'contrasenia',
   	'fecha_commit'
   ];

//No queremos que se asignen al modelo
   protected $guarded = [

   ];

}
