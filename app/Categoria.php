<?php

namespace sisVeterinaria;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'tbl_categoria';
    protected $primaryKey = 'id_categoria';

    public $timestamps = false;

    protected $fillable = [
    	'nombre_categoria',
    	'descipcion'
    ];

    protected $guarded = [
    	
    ];
}
