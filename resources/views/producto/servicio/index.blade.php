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
            <h3>Servicios</h3>
            @include('producto.servicio.search')
            <a href="servicio/create"><button class="btn btn-primary">Nuevo Servicio</button></a>
        </div> 
    </div>
    <hr>
    <div class="row">  
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table_responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th>ID</th>
                        <th>SERVICIO</th>
                        <th>DESCRIPCION</th>
                        <th>PRECIO</th>
                        <th>ESTADO</th>
                        <th>FECHA DE CREACION</th>
                        <th>USUARIO</th>
                        <th>OPCIONES</th>
                    </thead>
                    @foreach ($servicios as $servicio)
                    <tr>
                        <td>{{$servicio->id_servicio}}</td>
                        <td>{{$servicio->nombre_servicio}}</td>
                        <td>{{$servicio->descripcion}}</td>
                        <td>{{$servicio->precio_servicio}}</td>
                        <td>{{$servicio->estado}}</td>
                        <td>{{$servicio->fecha_commit}}</td>
                        <td>{{$servicio->usuario}}</td>
                        <td>
                            <a href="{{URL::action('ServicioController@edit',$servicio->id_servicio)}}"><button class="btn btn-info">Editar</button></a>
                            <a href="" data-target="#modal-delete-{{$servicio->id_servicio}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                        </td>
                    </tr>
                    @include('producto.servicio.modal')
                    @endforeach
                    
                </table>
            </div>
            {{$servicios->render()}}
        </div> 
    </div>

@endsection