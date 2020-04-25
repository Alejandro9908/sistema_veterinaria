<?php

namespace sisVeterinaria\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisVeterinaria\Http\Requests\ServicioRequest;
use sisVeterinaria\Servicio;
use Illuminate\Support\Facades\DB;

use sisVeterinaria\Http\Requests;
use sisVeterinaria\Http\Requests\TipoServicioRequest;

class ServicioController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            $servicios=DB::table('tbl_servicio as s')
            ->join('tbl_usuario as u','s.id_usuario','=','u.id_usuario')
            ->select('s.id_servicio','s.nombre_servicio','s.descripcion','s.precio_servicio',
            's.estado','s.fecha_commit','u.nick as usuario')
            ->where('s.nombre_servicio','LIKE','%'.$query.'%')
            ->where('s.estado','=','1')
            ->orderBy('s.id_servicio', 'desc')
           
            ->paginate(6);
            return view('producto.servicio.index',["servicios"=>$servicios,"searchText"=> $query]);
        }
    }

    public function create(){
        return view("producto.servicio.create");
    }

    public function store(ServicioRequest $request){
        $fecha = Carbon::now();
        $servicio = new Servicio();
        $servicio->nombre_servicio=$request->get('nombre_servicio');
        $servicio->descripcion=$request->get('descripcion');
        $servicio->precio_servicio=$request->get('precio_servicio');
        $servicio->fecha_commit=$fecha->format('Y-m-d h:i:s');
        $servicio->id_usuario='2';
        $servicio->estado='1';
        $servicio->save();
        return Redirect::to('producto/servicio');
    }

    public function show($id){
        return view("producto.servicio.show",["servicio"=>Servicio::findOrFail($id)]);
    }

    public function edit($id){
        $servicio=Servicio::findOrFail($id);
        return view("producto.servicio.edit",["servicio"=>$servicio]);
    }
    public function update(ServicioRequest $request, $id){
        $servicio=Servicio::findOrFail($id);
        $servicio->nombre_servicio=$request->get('nombre_servicio');
        $servicio->descripcion=$request->get('descripcion');
        $servicio->precio_servicio=$request->get('precio_servicio');
        $servicio->update();
        return Redirect::to('producto/servicio');
    }
    
    public function destroy($id){
       $servicio=Servicio::findOrFail($id);
       $servicio->estado="0";
       $servicio->update();
       return Redirect::to('producto/servicio');
    }
}
