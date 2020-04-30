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
            <h3>Servicios Pendientes</h3>
            @include('tableros.servicio.search')
            
        </div> 
    </div>
    <hr>
    <div class="row">  
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table_responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th>ID VENTA</th>
                        <th>ID DETALLE</th>
                        <th>SERVICIO</th>
                        <th>DESCRIPCION</th>
                        <th>FECHA PROGRAMADA</th>
                        <th>MASCOTA</th>
                        <th>CLIENTE</th>
                        <th>ESTADO</th>
                        <th>OPCIONES</th>
                    </thead>
                    @foreach ($detalles as $det)
                    <tr>
                        <td>{{$det->id_venta_servicio}}</td>
                        <td>{{$det->id_detalle_venta_servicio}}</td>
                        <td>{{$det->servicio}}</td>
                        <td>{{$det->descripcion}}</td>
                        <td>{{$det->fecha_programada}}</td>
                        <td>{{$det->mascota}}</td>
                        <td>{{$det->cliente}}</td>
                        @if($det->estado==1)
                            <td>PENDIENTE</td>
                        @else
                            <td>COMPLETADA</td>
                        @endif
                        <td>
                            <a href="" data-target="#modal-delete-{{$det->id_detalle_venta_servicio}}" data-toggle="modal"><button class="btn btn-info">Hecho</button></a>
                        </td>
                    </tr>
                    @include('tableros.servicio.modal')
                    @endforeach
                    
                </table>
            </div>
            {{$detalles->render()}}
        </div> 
    </div>

@endsection