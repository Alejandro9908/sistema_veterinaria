<?php

namespace sisVeterinaria;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'tbl_producto';
    protected $primaryKey = 'id_producto';

    public $timestamps = false;

    protected $fillable = [ 
        'codigo',  
        'nombre', 
        'id_categoria', 
        'descripcion',  
        'precio_venta', 
        'stock', 
        'imagen', 
        'fecha_commit', 
        'id_usuario',
        'estado'
    ];

    protected $guarded = [
    	
    ];
}
