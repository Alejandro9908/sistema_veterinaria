@extends('layouts.admin')
@section('contenido')
    <!--regilla bootstrap
    col-xs-(numero de columnas)
        telefonos =< 768px
    col-sm-(numero de columnas)
        tablets => 768px
    col-md-(numero de columnas)
        laptop/desktop => 992px
    col-lg-(numero de columnas)
        large desktop => 1200px
    -->

    <div class="row">  
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Categorias</h3>
            @include('producto.categoria.search')
            <a href="categoria/create"><button class="btn btn-primary">Nueva Categoria</button></a>
        </div> 
    </div>
    <hr>
    <div class="row">  
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table_responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>DESCRIPCION</th>
                        <th>OPCIONES</th>
                    </thead>
                    @foreach ($categorias as $cat)
                    <tr>
                        <td>{{$cat->id_categoria}}</td>
                        <td>{{$cat->nombre_categoria}}</td>
                        <td>{{$cat->descripcion}}</td>
                        <td>
                            <a href="{{URL::action('CategoriaController@edit',$cat->id_categoria)}}"><button class="btn btn-info">Editar</button></a>
                            <a href="" data-target="#modal-delete-{{$cat->id_categoria}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                        </td>
                    </tr>
                    @include('producto.categoria.modal')
                    @endforeach
                    
                </table>
            </div>
            {{$categorias->render()}}
        </div> 
    </div>

@endsection