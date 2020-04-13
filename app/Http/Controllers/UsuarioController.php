<?php

namespace sisVeterinaria\Http\Controllers;

use Illuminate\Http\Request;

use sisVeterinaria\Http\Requests;
use sisVeterinaria\Usuario;
use Illuminate\Support\Facades\Redirect;
use sisVeterinaria\Http\Requests\UsuarioFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class UsuarioController extends Controller
{
    //Declaramos un constructor
    public function __construct()
    {
    	//el constructor lo dejamos despues

    }

    public function index(Request $request)
    {
    	if ($request)
    	{
    		//trim es para quitar espacios en blanco tanto al inicio como al final
    		//todo se almacenar{a en la variable query}

    		$query=trim($request->get('searchText'));
    		$usuarios=DB::table('tbl_usuario')->where('nombres','LIKE', '%' .$query. '%')

    		->where ('estado','=','1')
    		->orderBy('id_usuario','desc')
    		->paginate(7);

    		return view('acceso.usuario.index',["usuarios"=>$usuarios, "searchText" =>$query]);

    	}
    }

    public function create() 
    {
    	return view ("acceso.usuario.create");
    }

    public function store(UsuarioFormRequest $request)
    {
        $fecha = Carbon::now();
    	$usuario=new Usuario;
    	$usuario->dpi= $request->get('dpi');
    	$usuario->nombres= $request->get('nombres');
    	$usuario->apellidos= $request->get('apellidos');
    	$usuario->fecha_nacimiento= $request->get('fecha_nacimiento');
    	$usuario->fecha_inicio= $request->get('fecha_inicio');
    	$usuario->telefono= $request->get('telefono');
    	$usuario->correo= $request->get('correo');
    	$usuario->direccion= $request->get('direccion');
    	$usuario->cargo= $request->get('cargo');
    	$usuario->permisos= $request->get('permisos');
    	$usuario->estado ='1';
    	$usuario->nick= $request->get('nick');
    	$usuario->contrasenia= $request->get('contrasenia');
    	$usuario->fecha_commit= $fecha->format('Y-m-d h:i:s');

    	$usuario->save();
    	return Redirect::to('acceso/usuario');

    }

    public function show($id)
    {

    	return view("acceso/usuario.show", ["usuario"=>Usuario::findOrFail($id)]);

    }

    public function edit($id)
    {
    	return view("acceso/usuario.edit", ["usuario"=>Usuario::findOrFail($id)]);
    }

    public function update(UsuarioFormRequest $request, $id)
    {
    	$usuario=Usuario::findOrFail($id);
    	$usuario->dpi= $request->get('dpi');
    	$usuario->nombres= $request->get('nombres');
    	$usuario->apellidos= $request->get('apellidos');
    	$usuario->fecha_nacimiento= $request->get('fecha_nacimiento');
    	$usuario->fecha_inicio= $request->get('fecha_inicio');
    	$usuario->telefono= $request->get('telefono');
    	$usuario->correo= $request->get('correo');
    	$usuario->direccion= $request->get('direccion');
    	$usuario->cargo= $request->get('cargo');
    	$usuario->permisos= $request->get('permisos');
    	$usuario->estado='1';
    	$usuario->nick= $request->get('nick');
    	$usuario->contrasenia= $request->get('contrasenia');
    	//$usuario->fecha_commit= $request->get('fecha_commit');

    	$usuario->update();

    	return Redirect::to('acceso/usuario');

    }

    public function destroy($id)
    {
    	$usuario=Usuario::findOrFail($id);
    	$usuario->estado='0';
    	$usuario->update();

    	return Redirect::to('acceso/usuario');
    }


}
