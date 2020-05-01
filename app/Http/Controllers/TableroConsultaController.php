<?php

namespace sisVeterinaria\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisVeterinaria\Http\Requests\TableroConsultaRequest;
use Illuminate\Support\Facades\DB;
use sisVeterinaria\Consulta;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Collection;
use PhpParser\Node\Stmt\TryCatch;
use sisVeterinaria\Http\Requests;

class TableroConsultaController extends Controller
{
    public function __construct(){
        $this-> middleware('auth');
    }

    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            $consultas=DB::table('tbl_consulta as v')
            ->join('tbl_mascota as m','v.id_mascota','=','m.id_mascota')
            ->join('tbl_cliente as c','c.id_cliente','=','m.id_cliente')
            ->join('tbl_usuario as u','v.id_usuario','=','u.id_usuario')
            ->select('v.id_consulta','v.fecha_commimt','m.nombre_mascota as mascota',DB::raw('CONCAT(c.nombres," ",c.apellidos) as cliente'),'v.tipo_comprobante',
            'v.serie','v.numero_comprobante','v.fecha_programada','v.precio_consulta','v.estado','v.sintomas','v.diagnostico')
            ->where('v.id_consulta','LIKE','%'.$query.'%')
            ->where('v.estado','=','1')
            ->orderBy('v.fecha_programada', 'asc')
            ->orderBy('v.id_consulta', 'asc')
            ->groupBy('v.id_consulta','v.fecha_commimt','m.nombre_mascota','v.tipo_comprobante',
            'v.serie','v.numero_comprobante')
            ->paginate(6);
            return view('tableros.consulta.index',["consultas"=>$consultas,"searchText"=> $query]);
        }
    }

    public function create(){

    }

    public function store(TableroConsultaRequest $request){
        return Redirect::to('ventas/consulta');  
    }

    public function edit($id){
        return view("tableros.consulta.edit",["consulta"=>Consulta::findOrFail($id)]);
    }
    public function update(TableroConsultaRequest $request, $id){
        $consulta=Consulta::findOrFail($id);
        $consulta->diagnostico=$request->get('diagnostico');
        $consulta->estado='2';
        $consulta->update();
        return Redirect::to('tableros/consulta');
    }

    public function show($id){

    }
    
    public function destroy($id){
        $consulta=Consulta::findOrFail($id);
        $consulta->estado='0';
        $consulta->update();
        return Redirect::to('tableros/consulta');  
    }
}
