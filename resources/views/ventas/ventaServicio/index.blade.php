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
            <h3>Ventas Servicios</h3>
            @include('ventas.ventaServicio.search')
            <a href="ventaServicio/create"><button class="btn btn-primary">Nueva Reserva</button></a>
        </div> 
    </div>
    <hr>
    <div class="row">  
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table_responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th>ID</th>
                        <th>FECHA</th>
                        <th>MASCOTA</th>
                        <th>CLIENTE</th>
                        <th>COMPROBANTE</th>
                        <th>SERIE</th>
                        <th>NUMERO</th>
                        <th>TOTAL</th>
                        <th>ESTADO</th>
                        <th>OPCIONES</th>
                    </thead>
                    @foreach ($ventasServicio as $venta)
                    <tr>
                        <td>{{$venta->id_venta_servicio}}</td>
                        <td>{{$venta->fecha_commit}}</td>
                        <td>{{$venta->mascota}}</td>
                        <td>{{$venta->cliente}}</td>
                        <td>{{$venta->tipo_comprobante}}</td>
                        <td>{{$venta->serie}}</td>
                        <td>{{$venta->id_venta_servicio}}</td>
                        <td>{{$venta->total}}</td>
                        <td>{{$venta->estado}}</td>
                        <td>
                            <a href="{{URL::action('VentaServicioController@show',$venta->id_venta_servicio)}}"><button class="btn btn-info">Mostrar</button></a>
                            <a href="" data-target="#modal-delete-{{$venta->id_venta_servicio}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
                        </td>
                    </tr>
                    @include('ventas.ventaServicio.modal')
                    @endforeach
                    
                </table>
            </div>
            {{$ventasServicio->render()}}
        </div> 
    </div>

@endsection