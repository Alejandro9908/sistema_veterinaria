<?php

namespace sisVeterinaria\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use sisVeterinaria\Http\Requests\ClienteRequest;
use Illuminate\Support\Facades\DB;
use sisVeterinaria\Cliente;
use sisVeterinaria\Http\Requests;

class ClienteController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            $clientes=DB::table('tbl_cliente as c')
            ->join('tbl_usuario as u','c.id_usuario','=','u.id_usuario')
            ->select('c.id_cliente','c.dpi','c.nombres','c.apellidos','c.telefono',
            'c.correo','c.direccion','c.estado','c.fecha_commit', 'u.nick as usuario')
            ->where('c.nombres','LIKE','%'.$query.'%')
            ->orwhere('c.apellidos','LIKE','%'.$query.'%')
            ->orwhere('c.id_cliente','LIKE','%'.$query.'%')
            ->orderBy('c.estado', 'desc')
            ->orderBy('c.id_cliente', 'desc')
            ->paginate(6);
            return view('ventas.cliente.index',["clientes"=>$clientes,"searchText"=> $query]);
        }
    }

    public function create(){
        return view("ventas.cliente.create");
    }

    public function store(ClienteRequest $request){
        $fecha = Carbon::now();
        $cliente = new Cliente;
        $cliente->dpi=$request->get('dpi');
        $cliente->nombres=$request->get('nombres');
        $cliente->apellidos=$request->get('apellidos');
        $cliente->telefono=$request->get('telefono');
        $cliente->correo=$request->get('correo');
        $cliente->direccion=$request->get('direccion');
        $cliente->estado='1';
        $cliente->fecha_commit=$fecha->format('Y-m-d h:i:s');
        $cliente->id_usuario='2';
        $cliente->save();
        return Redirect::to('ventas/cliente');
    }

    public function show($id){
        return view("ventas.cliente.show",["cliente"=>Cliente::findOrFail($id)]);
    }
    public function edit($id){
        return view("ventas.cliente.edit",["cliente"=>Cliente::findOrFail($id)]);
    }
    public function update(ClienteRequest $request, $id){
        $cliente=Cliente::findOrFail($id);
        $cliente->dpi=$request->get('dpi');
        $cliente->nombres=$request->get('nombres');
        $cliente->apellidos=$request->get('apellidos');
        $cliente->telefono=$request->get('telefono');
        $cliente->correo=$request->get('correo');
        $cliente->direccion=$request->get('direccion');
        $cliente->update();
        return Redirect::to('ventas/cliente');
    }
    public function destroy($id){
        $cliente=Cliente::findOrFail($id);
        $cliente->estado="0";
        $cliente->update();
        return Redirect::to('ventas/cliente');
    }
}
