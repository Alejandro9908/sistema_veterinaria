<?php

namespace sisVeterinaria\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisVeterinaria\Http\Requests\VentaServicioRequest;
use Illuminate\Support\Facades\DB;
use sisVeterinaria\VentaServicio;
use sisVeterinaria\DetalleVentaServicio;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Collection;
use PhpParser\Node\Stmt\TryCatch;
use sisVeterinaria\Http\Requests;

class VentaServicioController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            $ventasServicio=DB::table('tbl_venta_servicio as v')
            ->join('tbl_mascota as m','v.id_mascota','=','m.id_mascota')
            ->join('tbl_cliente as c','c.id_cliente','=','m.id_cliente')
            ->join('tbl_detalle_venta_servicio as dv','v.id_venta_servicio','=','dv.id_venta_servicio')
            ->select('v.id_venta_servicio','v.fecha_commit','m.nombre_mascota as mascota',DB::raw('CONCAT(c.nombres," ",c.apellidos) as cliente'),'v.tipo_comprobante',
            'v.serie','v.numero_comprobante',DB::raw('sum(dv.cantidad*dv.precio_venta) as total'),'v.estado')
            ->where('v.id_venta_servicio','LIKE','%'.$query.'%')
            ->orwhere('v.numero_comprobante','LIKE','%'.$query.'%')
            ->orderBy('v.id_venta_servicio', 'desc')
            ->groupBy('v.id_venta_servicio','v.fecha_commit','m.nombre_mascota','v.tipo_comprobante',
            'v.serie','v.numero_comprobante')
            ->paginate(6);
            return view('ventas.ventaServicio.index',["ventasServicio"=>$ventasServicio,"searchText"=> $query]);
        }
    }

    public function create(){
        $mascotas = DB::table('tbl_mascota as m')
            ->join('tbl_cliente as c','m.id_cliente','=','c.id_cliente')
            ->select(DB::raw('CONCAT(m.nombre_mascota," - ",c.dpi," - ",c.nombres," ",c.apellidos) as mascota'),'m.id_mascota')
            ->get();
        $servicios = DB::table('tbl_servicio as s')
            ->select(DB::raw('CONCAT(s.id_servicio," - ",s.nombre_servicio," - ",s.descripcion) as servicio'),'s.id_servicio','s.precio_servicio')
            ->where('s.estado','=','1')
            ->get();
        return view("ventas.ventaServicio.create",["mascotas"=>$mascotas,"servicios"=>$servicios]);
    }

    public function store(VentaServicioRequest $request){
        try{
            DB::beginTransaction();
            $fecha = Carbon::now();
            $ventaServicio = new VentaServicio;
            $ventaServicio->id_mascota=$request->get('id_mascota');
            $ventaServicio->tipo_comprobante=$request->get('tipo_comprobante');
            $ventaServicio->serie=$request->get('serie');
            $ventaServicio->numero_comprobante=$request->get('numero_comprobante');
            $ventaServicio->total_venta_servicio='0';
            $ventaServicio->estado='1';
            $ventaServicio->fecha_commit=$fecha->format('Y-m-d h:i:s');
            $ventaServicio->id_usuario='2';
            $ventaServicio->save();

            $id_tipo_servicio=$request->get('id_servicio');
            //$cantidad=$request->get('cantidad');
            $precio_venta=$request->get('precio_venta');

            $contador=0;

            while($contador < count($id_tipo_servicio)){
                $detalle = new DetalleVentaServicio;
                $detalle->id_venta_servicio=$ventaServicio->id_venta_servicio;
                $detalle->id_tipo_servicio=$id_tipo_servicio[$contador];
                $detalle->cantidad="1";
                $detalle->precio_venta=$precio_venta[$contador];
                $detalle->save();
                $contador=$contador+1;
            }
            DB::commit();

        }catch(\Exception $e){
            DB::rollback();
        }

        return Redirect::to('ventas/ventaServicio');  
    }

    public function show($id){
        $ventaServicio=DB::table('tbl_venta_servicio as v')
        ->join('tbl_mascota as m','v.id_mascota','=','m.id_mascota')
        ->join('tbl_cliente as c','c.id_cliente','=','m.id_cliente')
        ->join('tbl_detalle_venta_servicio as dv','v.id_venta_servicio','=','dv.id_venta_servicio')
        ->select('v.id_venta_servicio','v.fecha_commit','m.nombre_mascota',DB::raw('CONCAT(c.nombres," ",c.apellidos) as cliente'),'v.tipo_comprobante',
        'v.serie','v.numero_comprobante',DB::raw('sum(dv.cantidad*dv.precio_venta) as total'),'v.estado')
        ->where('v.id_venta_servicio','=',$id)
        ->first();

        $detalles=DB::table('tbl_detalle_venta_servicio as d')
        ->join('tbl_servicio as s','d.id_tipo_servicio','=','s.id_servicio')
        ->select('s.nombre_servicio as servicio','s.descripcion','d.fecha_programada','d.precio_venta')
        ->where('d.id_servicio','=',$id)
        ->get();

        return view("ventas.ventaServicio.show",["ventaServicio"=>$ventaServicio,"detalles"=>$detalles]);
    }
    
    public function destroy($id){
        $ventaServicio=VentaServicio::findOrFail($id);
        $ventaServicio->estado='0';
        $ventaServicio->update();
        return Redirect::to('ventas/ventaServicio');  
    }
}
