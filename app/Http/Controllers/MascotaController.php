<?php

namespace sisVeterinaria\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use sisVeterinaria\Http\Requests\MascotaRequest;
use Illuminate\Support\Facades\DB;
use sisVeterinaria\Mascota;

use sisVeterinaria\Http\Requests;

class MascotaController extends Controller
{
    public function __construct(){
        $this-> middleware('auth');
    }

    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            $mascotas=DB::table('tbl_mascota as m')
            ->join('tbl_cliente as c','m.id_cliente','=','c.id_cliente')
            ->join('tbl_usuario as u','m.id_usuario','=','u.id_usuario')
            ->select('m.id_mascota','m.nombre_mascota','c.id_cliente as cliente','c.nombres as nombre','c.apellidos as apellido','m.pedigri','m.sexo',
            'm.raza','m.especie','m.color_primario','m.color_secundario','m.fecha_nacimiento',
            'm.observacion','m.fecha_commit','m.estado','u.nick as usuario')
            ->where('m.nombre_mascota','LIKE','%'.$query.'%')
            ->where('m.estado','=','1')
            ->orderBy('m.id_mascota', 'desc')
            ->paginate(6);
            return view('ventas.mascota.index',["mascotas"=>$mascotas,"searchText"=> $query]);
        }
    }

    public function create(){
        $clientes = DB::table('tbl_cliente as c')
            ->select(DB::raw('CONCAT(c.id_cliente," - ",c.dpi," - ",c.nombres," ",c.apellidos) as cliente'),'c.id_cliente')
            ->where('c.estado','=','1')
            ->get();
        return view("ventas.mascota.create",["clientes"=>$clientes]);
    }
    
    
    public function store(MascotaRequest $request){
        $fecha = Carbon::now();
        $mascota = new Mascota;
        $mascota->id_cliente=$request->get('id_cliente');
        $mascota->nombre_mascota=$request->get('nombre_mascota');
        $mascota->pedigri=$request->get('pedigri');
        $mascota->raza=$request->get('raza');
        $mascota->sexo=$request->get('sexo');
        $mascota->color_primario=$request->get('color_primario');
        $mascota->color_secundario=$request->get('color_secundario');
        $mascota->fecha_nacimiento=$request->get('fecha_nacimiento');
        $mascota->observacion=$request->get('observacion');
        $mascota->fecha_primer_ingreso=$fecha->format('Y-m-d h:i:s');
        $mascota->estado='1';
        $mascota->fecha_commit=$fecha->format('Y-m-d h:i:s');
        $mascota->especie=$request->get('especie');
        $mascota->id_usuario=$request->get('id_usuario');
        $mascota->save();
        return Redirect::to('ventas/mascota');
    }
    
    public function show($id){
        return view("ventas.mascota.show",["mascota"=>Mascota::findOrFail($id)]);
    }
    
    public function edit($id){
        $clientes = DB::table('tbl_cliente as c')
            ->select(DB::raw('CONCAT(c.id_cliente," - ",c.dpi," - ",c.nombres," ",c.apellidos) as cliente'),'c.id_cliente')
            ->where('c.estado','=','1')
            ->get();
        return view("ventas.mascota.edit",["mascota"=>Mascota::findOrFail($id),"clientes"=>$clientes]);
    }
       
    public function update(MascotaRequest $request, $id){
        $mascota=Mascota::findOrFail($id);
        $mascota->id_cliente=$request->get('id_cliente');
        $mascota->nombre_mascota=$request->get('nombre_mascota');
        $mascota->pedigri=$request->get('pedigri');
        $mascota->raza=$request->get('raza');
        $mascota->sexo=$request->get('sexo');
        $mascota->color_primario=$request->get('color_primario');
        $mascota->color_secundario=$request->get('color_secundario');
        $mascota->fecha_nacimiento=$request->get('fecha_nacimiento');
        $mascota->observacion=$request->get('observacion');
        $mascota->especie=$request->get('especie');
        $mascota->update();
        return Redirect::to('ventas/mascota');
    }
    
    public function destroy($id){
        $mascota=Mascota::findOrFail($id);
        $mascota->estado="0";
        $mascota->update();
        return Redirect::to('ventas/mascota');
    }
    
}
