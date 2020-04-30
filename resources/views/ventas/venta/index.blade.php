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
            <h3>Ventas</h3>
            @include('ventas.venta.search')
            <a href="venta/create"><button class="btn btn-primary">Nueva Venta</button></a>
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
                        <th>CLIENTE</th>
                        <th>COMPROBANTE</th>
                        <th>SERIE</th>
                        <th>NUMERO</th>
                        <th>TOTAL</th>
                        <th>ESTADO</th>
                        <th>OPCIONES</th>
                    </thead>
                    @foreach ($ventas as $ven)
                    <tr>
                        <td>{{$ven->id_venta}}</td>
                        <td>{{$ven->fecha_commit}}</td>
                        <td>{{$ven->cliente}}</td>
                        <td>{{$ven->tipo_comprobante}}</td>
                        <td>{{$ven->serie}}</td>
                        <td>{{$ven->numero_comprobante}}</td>
                        <td>{{$ven->total}}</td>
                        <td>{{$ven->estado}}</td>
                        <td>
                            <a href="{{URL::action('VentaController@show',$ven->id_venta)}}"><button class="btn btn-info">Mostrar</button></a>
                            <a href="" data-target="#modal-delete-{{$ven->id_venta}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
                        </td>
                    </tr>
                    @include('ventas.venta.modal')
                    @endforeach
                    
                </table>
            </div>
            {{$ventas->render()}}
        </div> 
    </div>

@endsection