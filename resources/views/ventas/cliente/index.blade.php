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
            <h3>Clientes</h3>
            @include('ventas.cliente.search')
            <a href="cliente/create"><button class="btn btn-primary">Nuevo Cliente</button></a>
        </div> 
    </div>
    <hr>
    <div class="row">  
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table_responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th>ID</th>
                        <th>DPI</th>
                        <th>NOMBRES</th>
                        <th>APELLIDOS</th>
                        <th>TELEFONO</th>
                        <th>CORREO</th>
                        <th>DIRECCION</th>
                        <th>ESTADO</th>
                        <th>FECHA DE CREACION</th>
                        <th>USUARIO</th>
                        <th>OPCIONES</th>
                    </thead>
                    @foreach ($clientes as $cli)
                    <tr>
                        <td>{{$cli->id_cliente}}</td>
                        <td>{{$cli->dpi}}</td>
                        <td>{{$cli->nombres}}</td>
                        <td>{{$cli->apellidos}}</td>
                        <td>{{$cli->telefono}}</td>
                        <td>{{$cli->correo}}</td>
                        <td>{{$cli->direccion}}</td>
                        @if($cli->estado==1)
                            <td>ACTIVO</td>
                        @else
                            <td>DE BAJA</td>
                        @endif
                        <td>{{$cli->fecha_commit}}</td>
                        <td>{{$cli->usuario}}</td>
                        <td>
                            <a href="{{URL::action('ClienteController@edit',$cli->id_cliente)}}"><button class="btn btn-info">Editar</button></a>
                            <a href="" data-target="#modal-delete-{{$cli->id_cliente}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                        </td>
                    </tr>
                    @include('ventas.cliente.modal')
                    @endforeach
                    
                </table>
            </div>
            {{$clientes->render()}}
        </div> 
    </div>

@endsection