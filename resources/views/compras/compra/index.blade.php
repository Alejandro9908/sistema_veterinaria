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
            <h3>Compras</h3>
            @include('compras.compra.search')
            <a href="compra/create"><button class="btn btn-primary">Nueva Compra</button></a>
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
                        <th>PROVEEDOR</th>
                        <th>COMPROBANTE</th>
                        <th>SERIE</th>
                        <th>NUMERO</th>
                        <th>TOTAL</th>
                        <th>ESTADO</th>
                        <th>OPCIONES</th>
                    </thead>
                    @foreach ($compras as $com)
                    <tr>
                        <td>{{$com->id_compra}}</td>
                        <td>{{$com->fecha_commit}}</td>
                        <td>{{$com->razon_social}}</td>
                        <td>{{$com->tipo_comprobante}}</td>
                        <td>{{$com->serie}}</td>
                        <td>{{$com->numero_comprobante}}</td>
                        <td>{{$com->total}}</td>
                        <td>{{$com->estado}}</td>
                        <td>
                            <a href="{{URL::action('CompraController@show',$com->id_compra)}}"><button class="btn btn-info">Mostrar</button></a>
                            <a href="" data-target="#modal-delete-{{$com->id_compra}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
                        </td>
                    </tr>
                    @include('compras.compra.modal')
                    @endforeach
                    
                </table>
            </div>
            {{$compras->render()}}
        </div> 
    </div>

@endsection