<?php

namespace sisVeterinaria\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisVeterinaria\Http\Requests\CompraRequest;
use Illuminate\Support\Facades\DB;
use sisVeterinaria\Compra;
use sisVeterinaria\DetalleCompra;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Collection;
use PhpParser\Node\Stmt\TryCatch;
use sisVeterinaria\Http\Requests;

class CompraController extends Controller
{
    public function __construct(){
        $this-> middleware('auth');
    }

    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            $compras=DB::table('tbl_compra as c')
            ->join('tbl_proveedor as p','c.id_proveedor','=','p.id_proveedor')
            ->join('tbl_detalle_compra as d','c.id_compra','=','d.id_compra')
            ->select('c.id_compra','c.fecha_commit','p.razon_social','c.tipo_comprobante',
            'c.serie','c.numero_comprobante',DB::raw('sum(d.cantidad*d.precio_compra) as total'),'c.estado')
            ->where('c.id_compra','LIKE','%'.$query.'%')
            ->orwhere('c.numero_comprobante','LIKE','%'.$query.'%')
            ->orderBy('c.id_compra', 'desc')
            ->groupBy('c.id_compra','c.fecha_commit','p.razon_social','c.tipo_comprobante',
            'c.serie','c.numero_comprobante')
            ->paginate(6);
            return view('compras.compra.index',["compras"=>$compras,"searchText"=> $query]);
        }
    }

    public function create(){
        $proveedores = DB::table('tbl_proveedor')->get();
        $productos = DB::table('tbl_producto as p')
            ->select(DB::raw('CONCAT(p.id_producto,"  ",p.nombre) as product'),'p.id_producto')
            ->where('p.estado','=','1')
            ->get();
        return view("compras.compra.create",["proveedores"=>$proveedores,"productos"=>$productos]);
    }

    public function store(CompraRequest $request){
        try{
            DB::beginTransaction();
            $fecha = Carbon::now();
            $compra = new Compra;
            $compra->id_proveedor=$request->get('id_proveedor');
            $compra->tipo_comprobante=$request->get('tipo_comprobante');
            $compra->serie=$request->get('serie');
            $compra->numero_comprobante=$request->get('numero_comprobante');
            $compra->total_compra='0';
            $compra->estado='1';
            $compra->fecha_commit=$fecha->format('Y-m-d h:i:s');
            $compra->id_usuario=$request->get('id_usuario');
            $compra->save();

            $id_producto=$request->get('id_producto');
            $cantidad=$request->get('cantidad');
            $precio_compra=$request->get('precio_compra');
            $precio_venta=$request->get('precio_venta');

            $contador=0;

            while($contador < count($id_producto)){
                $detalle = new DetalleCompra;
                $detalle->id_compra=$compra->id_compra;
                $detalle->id_producto=$id_producto[$contador];
                $detalle->cantidad=$cantidad[$contador];
                $detalle->precio_compra=$precio_compra[$contador];
                $detalle->precio_venta=$precio_venta[$contador];
                $detalle->save();
                $contador=$contador+1;
            }
            DB::commit();

        }catch(\Exception $e){
            DB::rollback();
        }

        return Redirect::to('compras/compra');  
    }

    public function show($id){
        $compra=DB::table('tbl_compra as c')
        ->join('tbl_proveedor as p','c.id_proveedor','=','p.id_proveedor')
        ->join('tbl_detalle_compra as d','c.id_compra','=','d.id_compra')
        ->select('c.id_compra','c.fecha_commit','p.razon_social','c.tipo_comprobante',
        'c.serie','c.numero_comprobante',DB::raw('sum(d.cantidad*d.precio_compra) as total'))
        ->where('c.id_compra','=',$id)
        ->first();

        $detalles=DB::table('tbl_detalle_compra as d')
        ->join('tbl_producto as p','d.id_producto','=','p.id_producto')
        ->select('p.nombre as producto','d.cantidad','d.precio_compra','d.precio_venta')
        ->where('d.id_compra','=',$id)
        ->get();

        return view("compras.compra.show",["compra"=>$compra,"detalles"=>$detalles]);
    }
    
    public function destroy($id){
        $compra=Compra::findOrFail($id);
        $compra->estado='0';
        $compra->update();
        return Redirect::to('compras/compra');  
    }
}
