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
            <h3>Mascotas</h3>
            @include('ventas.mascota.search')
            <a href="mascota/create"><button class="btn btn-primary">Nueva Mascota</button></a>
        </div> 
    </div>
    <hr>
    <div class="row">  
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table_responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th>MASCOTA</th>
                        <th>DUEÑO</th>
                        <th>APELLIDO</th>
                        <th>PEDIGRI</th>
                        <th>GENERO</th>
                        <th>RAZA</th>
                        <th>ESPECIE</th>
                        <th>COLOR PRIMARIO</th>
                        <th>COLOR SECUNDARIO</th>
                        <th>CUMPLEAÑOS</th>
                        <th>OBSERVACION</th>
                        <th>FECHA INGRESO</th>
                        <th>ESTADO</th>
                        <th>USUARIO</th>
                        <th>OPCIONES</th>
                    </thead>
                    @foreach ($mascotas as $mascota)
                    <tr>
                        <td>{{$mascota->nombre_mascota}}</td>
                        <td>{{$mascota->nombre}}</td>
                        <td>{{$mascota->apellido}}</td>
                        <td>{{$mascota->pedigri}}</td>
                        <td>{{$mascota->sexo}}</td>
                        <td>{{$mascota->raza}}</td>
                        <td>{{$mascota->especie}}</td>
                        <td>{{$mascota->color_primario}}</td>
                        <td>{{$mascota->color_secundario}}</td>
                        <td>{{$mascota->fecha_nacimiento}}</td>
                        <td>{{$mascota->observacion}}</td>
                        <td>{{$mascota->fecha_commit}}</td>
                        <td>{{$mascota->estado}}</td>
                        <td>{{$mascota->usuario}}</td>
                        <td>
                            <a href="{{URL::action('MascotaController@edit',$mascota->id_mascota)}}"><button class="btn btn-info">Editar</button></a>
                            <a href="" data-target="#modal-delete-{{$mascota->id_mascota}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                        </td>
                    </tr>
                    @include('ventas.mascota.modal')
                    @endforeach
                    
                </table>
            </div>
            {{$mascotas->render()}}
        </div> 
    </div>

@endsection