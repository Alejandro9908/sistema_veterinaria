<?php

namespace sisVeterinaria\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use sisVeterinaria\Http\Requests\ProveedorRequest;
use Illuminate\Support\Facades\DB;
use sisVeterinaria\Proveedor;
use Carbon\Carbon;
use sisVeterinaria\Http\Requests;

class ProveedorController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            $proveedores=DB::table('tbl_proveedor as p')
            ->join('tbl_usuario as u','p.id_usuario','=','u.id_usuario')
            ->select('p.id_proveedor','p.nit','p.razon_social','p.descripcion','p.telefono',
            'p.correo','p.pagina_web','p.direccion','p.estado','p.fecha_commit', 'u.nick as usuario')
            ->where('p.razon_social','LIKE','%'.$query.'%')
            ->orwhere('p.id_proveedor','LIKE','%'.$query.'%')
            ->orderBy('p.id_proveedor', 'desc')
            ->paginate(6);
            return view('compras.proveedor.index',["proveedores"=>$proveedores,"searchText"=> $query]);
        }
    }

    public function create(){
        return view("compras.proveedor.create");
    }

    public function store(ProveedorRequest $request){
        $fecha = Carbon::now();
        $proveedor = new Proveedor;
        $proveedor->nit=$request->get('nit');
        $proveedor->razon_social=$request->get('razon_social');
        $proveedor->descripcion=$request->get('descripcion');
        $proveedor->telefono=$request->get('telefono');
        $proveedor->correo=$request->get('correo');
        $proveedor->pagina_web=$request->get('pagina_web');
        $proveedor->direccion=$request->get('direccion');
        $proveedor->estado='1';
        $proveedor->fecha_commit=$fecha->format('Y-m-d h:i:s');
        $proveedor->id_usuario='2';
        $proveedor->save();
        return Redirect::to('compras/proveedor');
    }

    public function show($id){
        return view("compras.proveedor.show",["proveedor"=>Proveedor::findOrFail($id)]);
    }
    public function edit($id){
        return view("compras.proveedor.edit",["proveedor"=>Proveedor::findOrFail($id)]);
    }
    public function update(ProveedorRequest $request, $id){
        $proveedor=Proveedor::findOrFail($id);
        $proveedor->nit=$request->get('nit');
        $proveedor->razon_social=$request->get('razon_social');
        $proveedor->descripcion=$request->get('descripcion');
        $proveedor->telefono=$request->get('telefono');
        $proveedor->correo=$request->get('correo');
        $proveedor->pagina_web=$request->get('pagina_web');
        $proveedor->direccion=$request->get('direccion');
        $proveedor->update();
        return Redirect::to('compras/proveedor');
    }
    public function destroy($id){
        $proveedor=Proveedor::findOrFail($id);
        $proveedor->estado="0";
        $proveedor->update();
        return Redirect::to('compras/proveedor');
    }
}
