<?php

namespace sisVeterinaria\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisVeterinaria\Http\Requests\TableroDetalleVentaServicioRequest;
use Illuminate\Support\Facades\DB;
use sisVeterinaria\DetalleVentaServicio;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Collection;
use PhpParser\Node\Stmt\TryCatch;
use sisVeterinaria\DetalleVenta;
use sisVeterinaria\Http\Requests;

class TableroDetalleVentaServicioController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){
        $fecha = Carbon::now();
        if($request){
            $query=trim($request->get('searchText'));
            $detalles=DB::table('tbl_detalle_venta_servicio as d')
            ->join('tbl_servicio as s','s.id_servicio','=','d.id_servicio')
            ->join('tbl_venta_servicio as v','v.id_venta_servicio','=','d.id_venta_servicio')
            ->join('tbl_mascota as m','m.id_mascota','=','v.id_mascota')
            ->join('tbl_cliente as c','c.id_cliente','=','m.id_cliente')
            ->select('v.id_venta_servicio','d.id_detalle_venta_servicio','s.nombre_servicio as servicio',
            's.descripcion','d.fecha_programada','m.nombre_mascota as mascota','c.nombres as cliente','d.estado')
            ->where('m.nombre_mascota','LIKE','%'.$query.'%')
            ->where('v.estado','=','1')
            ->where('d.estado','=','1')
            ->orderBy('d.fecha_programada', 'asc')
            ->orderBy('d.id_detalle_venta_servicio', 'asc')
            ->paginate(6);
            return view('tableros.servicio.index',["detalles"=>$detalles,"searchText"=> $query]);
        }
    }

    public function create(){
        
    }
    
    
    public function store(TableroDetalleVentaServicioRequest $request){

    }
    
    public function show($id){
        return view("tableros.servicio.show",["detalle"=>DetalleVentaServicio::findOrFail($id)]);
    }
    
    public function edit($id){
        return view("tableros.servicio.edit",["detalle"=>DetalleVentaServicio::findOrFail($id)]);
    }
       
    public function update(TableroDetalleVentaServicioRequest $request, $id){
        
    }
    
    public function destroy($id){
        $detalle=DetalleVentaServicio::findOrFail($id);
        $detalle->estado="2";
        $detalle->update(); 
        return Redirect::to('tableros/servicio');     
    }
}
