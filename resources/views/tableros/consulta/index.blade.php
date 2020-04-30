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
            <h3>Consultas Pendientes</h3>
            @include('tableros.consulta.search')
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
                        <th>FECHA PROGRAMADA</th>
                        <th>PRECIO</th>
                        <th>ESTADO</th>
                        <th>OPCIONES</th>
                    </thead>
                    @foreach ($consultas as $con)
                    <tr>
                        <td>{{$con->id_consulta}}</td>
                        <td>{{$con->fecha_commimt}}</td>
                        <td>{{$con->mascota}}</td>
                        <td>{{$con->cliente}}</td>
                        <td>{{$con->tipo_comprobante}}</td>
                        <td>{{$con->serie}}</td>
                        <td>{{$con->id_consulta}}</td>
                        <td>{{$con->fecha_programada}}</td>
                        <td>{{$con->precio_consulta}}</td>
                        @if($con->estado==1)
                        <td>ACTIVO</td>
                        @endif
                        @if($con->estado==0)
                        <td>ANULADO</td>
                        @endif
                        @if($con->estado==2)
                        <td>COMPLETADO</td>
                        @endif
                        <td>
                            <a href="{{URL::action('TableroConsultaController@edit',$con->id_consulta)}}"><button class="btn btn-info">Mostrar</button></a>
                        </td>
                    </tr>
                    @include('tableros.consulta.modal')
                    @endforeach
                    
                </table>
            </div>
            {{$consultas->render()}}
        </div> 
    </div>

@endsection