<?php

namespace sisVeterinaria\Http\Controllers;

use Illuminate\Http\Request;

use sisVeterinaria\Http\Requests;
use sisVeterinaria\Categoria;
use Illuminate\Support\Facades\Redirect;
use sisVeterinaria\Http\Requests\CategoriaRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoriaController extends Controller{
    public function __construct(){
        $this-> middleware('auth');
    }

    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            $categorias=DB::table('tbl_categoria')
            ->where('nombre_categoria','LIKE','%'.$query.'%')
            ->orderBy('id_categoria', 'desc')
            ->paginate(6);
            return view('producto.categoria.index',["categorias"=>$categorias,"searchText"=> $query]);
        }
    }

    public function create(){
        return view("producto.categoria.create");
    }

    public function store(CategoriaRequest $request){
        $categoria = new Categoria;
        $categoria->nombre_categoria=$request->get('nombre_categoria');
        $categoria->descripcion=$request->get('descripcion');
        $categoria->save();
        return Redirect::to('producto/categoria');
    }

    public function show($id){
        return view("producto.categoria.show",["categoria"=>Categoria::findOrFail($id)]);
    }
    public function edit($id){
        return view("producto.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);
    }
    public function update(CategoriaRequest $request, $id){
        $categoria=Categoria::findOrFail($id);
        $categoria->nombre_categoria=$request->get('nombre_categoria');
        $categoria->descripcion=$request->get('descripcion');
        $categoria->update();
        return Redirect::to('producto/categoria');
    }
    public function destroy($id){
       $categoria=Categoria::findOrFail($id);
       $categoria->delete();
       return Redirect::to('producto/categoria');
    }
}
