<?php

namespace sisVeterinaria\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisVeterinaria\Http\Requests\ProductoRequest;
use sisVeterinaria\Producto;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller{
    public function __construct(){
        $this-> middleware('auth');
    }

    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            $productos=DB::table('tbl_producto as p')
            ->join('tbl_categoria as c','p.id_categoria','=','c.id_categoria')
            ->select('p.id_producto','p.nombre','c.nombre_categoria as categoria',
            'p.descripcion','p.precio_venta as precio','p.stock','p.imagen','p.estado')
            ->where('p.nombre','LIKE','%'.$query.'%')
            ->orwhere('p.id_producto','LIKE','%'.$query.'%')
            ->orderBy('p.id_producto', 'desc')
           
            ->paginate(6);
            return view('producto.producto.index',["productos"=>$productos,"searchText"=> $query]);
        }
    }

    public function create(){
        $categorias = DB::table('tbl_categoria')->get();
        return view("producto.producto.create",["categorias"=>$categorias]);
    }

    public function store(ProductoRequest $request){
        $fecha = Carbon::now();
        $producto = new Producto;
        $producto->codigo=$request->get('codigo');
        $producto->nombre=$request->get('nombre');
        $producto->id_categoria=$request->get('id_categoria');
        $producto->descripcion=$request->get('descripcion');
        $producto->precio_venta=$request->get('precio_venta');
        $producto->stock=$request->get('stock');
        $producto->fecha_commit=$fecha->format('Y-m-d');
        $producto->id_usuario=$request->get('id_usuario');
        $producto->estado='1';
        if(Input::hasFile('imagen')){
            $file=Input::file('imagen');
            $file->move(\public_path('/imagenes/productos/',$file->getClientOriginalName()));
            $producto->imagen=$file->getClientOriginalName();
        }
        
        $producto->save();
        return Redirect::to('producto/producto');
    }

    public function show($id){
        return view("producto.producto.show",["producto"=>Producto::findOrFail($id)]);
    }
    public function edit($id){
        $producto=Producto::findOrFail($id);
        $categorias=DB::table('tbl_categoria')->get();
        return view("producto.producto.edit",["producto"=>$producto,"categorias"=>$categorias]);
    }
    public function update(ProductoRequest $request, $id){
        $producto=Producto::findOrFail($id);
        $producto->nombre=$request->get('nombre');
        $producto->id_categoria=$request->get('id_categoria');
        $producto->descripcion=$request->get('descripcion');
        $producto->precio_venta=$request->get('precio_venta');
        $producto->stock=$request->get('stock');
        if(Input::hasFile('imagen')){
            $file=Input::file('imagen');
            $file->move(\public_path('/imagenes/productos/',$file->getClientOriginalName()));
            $producto->imagen=$file->getClientOriginalName();
        }
        $producto->update();
        return Redirect::to('producto/producto');
    }
    public function destroy($id){
       $producto=Producto::findOrFail($id);
       $producto->estado="0";
       $producto->update();
       return Redirect::to('producto/producto');
    }
}
