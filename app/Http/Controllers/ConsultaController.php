<?php

namespace sisVeterinaria\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisVeterinaria\Http\Requests\ConsultaRequest;
use Illuminate\Support\Facades\DB;
use sisVeterinaria\Consulta;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Collection;
use PhpParser\Node\Stmt\TryCatch;
use sisVeterinaria\Http\Requests;

class ConsultaController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            $consultas=DB::table('tbl_consulta as v')
            ->join('tbl_mascota as m','v.id_mascota','=','m.id_mascota')
            ->join('tbl_cliente as c','c.id_cliente','=','m.id_cliente')
            ->select('v.id_consulta','v.fecha_commimt','m.nombre_mascota as mascota',DB::raw('CONCAT(c.nombres," ",c.apellidos) as cliente'),'v.tipo_comprobante',
            'v.serie','v.numero_comprobante','v.fecha_programada','v.precio_consulta','v.estado')
            ->where('v.id_consulta','LIKE','%'.$query.'%')
            ->where('v.estado','=','1')
            ->orwhere('v.estado','=','2')
            ->orderBy('v.id_consulta', 'desc')
            ->groupBy('v.id_consulta','v.fecha_commimt','m.nombre_mascota','v.tipo_comprobante',
            'v.serie','v.numero_comprobante')
            ->paginate(6);
            return view('ventas.consulta.index',["consultas"=>$consultas,"searchText"=> $query]);
        }
    }

    public function create(){
        $mascotas = DB::table('tbl_mascota as m')
            ->join('tbl_cliente as c','m.id_cliente','=','c.id_cliente')
            ->select(DB::raw('CONCAT(m.nombre_mascota," - ",c.dpi," - ",c.nombres," ",c.apellidos) as mascota'),'m.id_mascota')
            ->where("m.estado","=","1")
            ->get();
        return view("ventas.consulta.create",["mascotas"=>$mascotas]);
    }

    public function store(ConsultaRequest $request){
    
            $fecha = Carbon::now();
            $consulta = new Consulta;
            $consulta->id_mascota=$request->get('id_mascota');
            $consulta->sintomas=$request->get('sintomas');
            $consulta->diagnostico="";
            $consulta->precio_consulta=$request->get('precio_consulta');
            $consulta->fecha_programada=$request->get('fecha_programada');
            $consulta->estado='1';
            $consulta->fecha_commimt=$fecha->format('Y-m-d h:i:s');
            $consulta->id_usuario='2';
            $consulta->tipo_comprobante=$request->get('tipo_comprobante');
            $consulta->serie=$request->get('serie');
            $consulta->numero_comprobante=$request->get('numero_comprobante');
            $consulta->save();

        return Redirect::to('ventas/consulta');  
    }

    public function show($id){
        $consulta=DB::table('tbl_consulta as v')
        ->join('tbl_mascota as m','v.id_mascota','=','m.id_mascota')
        ->join('tbl_cliente as c','c.id_cliente','=','m.id_cliente')
        ->join('tbl_usuario as u','v.id_usuario','=','u.id_usuario')
        ->select('v.id_consulta','v.fecha_commimt','m.nombre_mascota as mascota',
        'v.sintomas','v.diagnostico',DB::raw('CONCAT(c.nombres," ",c.apellidos) as cliente'),
        'v.tipo_comprobante','v.serie','v.numero_comprobante','v.fecha_programada',
        'v.precio_consulta','v.estado','u.nick')
        ->where('v.id_consulta','=',$id)
        ->first();

        return view("ventas.consulta.show",["consulta"=>$consulta]);
    }
    
    public function destroy($id){
        $consulta=Consulta::findOrFail($id);
        $consulta->estado='0';
        $consulta->update();
        return Redirect::to('ventas/consulta');  
    }
}
