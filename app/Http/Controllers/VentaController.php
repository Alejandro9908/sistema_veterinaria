<?php

namespace sisVeterinaria\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisVeterinaria\Http\Requests\VentaRequest;
use Illuminate\Support\Facades\DB;
use sisVeterinaria\Venta;
use sisVeterinaria\DetalleVenta;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Collection;
use PhpParser\Node\Stmt\TryCatch;
use sisVeterinaria\Http\Requests;

class VentaController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            $ventas=DB::table('tbl_venta as v')
            ->join('tbl_cliente as c','c.id_cliente','=','v.id_cliente')
            ->join('tbl_detalle_venta as d','v.id_venta','=','d.id_venta')
            ->select('v.id_venta','v.fecha_commit','c.nombres as cliente','v.tipo_comprobante',
            'v.serie','v.numero_comprobante','v.total_venta as total','v.estado')
            ->where('v.id_venta','LIKE','%'.$query.'%')
            ->orwhere('v.numero_comprobante','LIKE','%'.$query.'%')
            ->orderBy('v.id_venta', 'desc')
            ->groupBy('v.id_venta','v.fecha_commit','c.nombres','v.tipo_comprobante',
            'v.serie','v.numero_comprobante')
            ->paginate(6);
            return view('ventas.venta.index',["ventas"=>$ventas,"searchText"=> $query]);
        }
    }

    public function create(){
        $clientes = DB::table('tbl_cliente as c')
            ->select(DB::raw('CONCAT(c.id_cliente," - ",c.dpi," - ",c.nombres," ",c.apellidos) as cliente'),
            'c.id_cliente')
            ->where('c.estado','=','1')
            ->get();
        $productos = DB::table('tbl_producto as p')
            ->select(DB::raw('CONCAT(p.id_producto,"  ",p.nombre) as producto'),
            'p.id_producto','p.stock','p.precio_venta')
            ->where('p.estado','=','1')
            ->where('p.stock','>','0')
            ->get();
        return view("ventas.venta.create",["clientes"=>$clientes,"productos"=>$productos]);
    }

    public function store(VentaRequest $request){
        try{
            DB::beginTransaction();
            $fecha = Carbon::now();
            $venta = new Venta;
            $venta->id_cliente=$request->get('id_cliente');
            $venta->tipo_comprobante=$request->get('tipo_comprobante');
            $venta->serie=$request->get('serie');
            $venta->numero_comprobante=$request->get('numero_comprobante');
            $venta->total_venta=$request->get('total_venta');
            $venta->estado='1';
            $venta->fecha_commit=$fecha->format('Y-m-d h:i:s');
            $venta->id_usuario='2';
            $venta->save();

            $id_producto=$request->get('id_producto');
            $cantidad=$request->get('cantidad');
            $precio_venta=$request->get('precio_venta');

            $contador=0;

            while($contador < count($id_producto)){
                $detalle = new DetalleVenta;
                $detalle->id_venta=$venta->id_venta;
                $detalle->id_producto=$id_producto[$contador];
                $detalle->cantidad=$cantidad[$contador];
                $detalle->precio_venta=$precio_venta[$contador];
                $detalle->save();
                $contador=$contador+1;
            }
            DB::commit();

        }catch(\Exception $e){
            DB::rollback();
        }

        return Redirect::to('ventas/venta');  
    }

    public function show($id){
        $venta=DB::table('tbl_venta as v')
        ->join('tbl_cliente as c','c.id_cliente','=','v.id_cliente')
        ->join('tbl_detalle_venta as d','v.id_venta','=','d.id_venta')
        ->select('v.id_venta','v.fecha_commit','c.nombres as cliente','v.tipo_comprobante',
        'v.serie','v.numero_comprobante','v.total_venta as total','v.estado')
        ->where('v.id_venta','=',$id)
        ->first();

        $detalles=DB::table('tbl_detalle_venta as d')
        ->join('tbl_producto as p','d.id_producto','=','p.id_producto')
        ->select('p.nombre as producto','d.cantidad','d.precio_venta')
        ->where('d.id_venta','=',$id)
        ->get();

        return view("ventas.venta.show",["venta"=>$venta,"detalles"=>$detalles]);
    }
    
    public function destroy($id){
        $venta=Venta::findOrFail($id);
        $venta->estado='0';
        $venta->update();
        return Redirect::to('ventas/venta');  
    }
}
