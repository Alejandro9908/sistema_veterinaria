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
            <h3>Proveedores</h3>
            @include('compras.proveedor.search')
            <a href="proveedor/create"><button class="btn btn-primary">Nuevo Proveedor</button></a>
        </div> 
    </div>
    <hr>
    <div class="row">  
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table_responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th>ID</th>
                        <th>NIT</th>
                        <th>NOMBRE</th>
                        <th>DESCRIPCION</th>
                        <th>TELEFONO</th>
                        <th>CORREO</th>
                        <th>WEB</th>
                        <th>DIRECCION</th>
                        <th>ESTADO</th>
                        <th>FECHA DE CREACION</th>
                        <th>USUARIO</th>
                        <th>OPCIONES</th>
                    </thead>
                    @foreach ($proveedores as $prov)
                    <tr>
                        <td>{{$prov->id_proveedor}}</td>
                        <td>{{$prov->nit}}</td>
                        <td>{{$prov->razon_social}}</td>
                        <td>{{$prov->descripcion}}</td>
                        <td>{{$prov->telefono}}</td>
                        <td>{{$prov->correo}}</td>
                        <td>{{$prov->pagina_web}}</td>
                        <td>{{$prov->direccion}}</td>
                        <td>{{$prov->estado}}</td>
                        <td>{{$prov->fecha_commit}}</td>
                        <td>{{$prov->usuario}}</td>
                        <td>
                            <a href="{{URL::action('ProveedorController@edit',$prov->id_proveedor)}}"><button class="btn btn-info">Editar</button></a>
                            <a href="" data-target="#modal-delete-{{$prov->id_proveedor}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                        </td>
                    </tr>
                    @include('compras.proveedor.modal')
                    @endforeach
                    
                </table>
            </div>
            {{$proveedores->render()}}
        </div> 
    </div>

@endsection