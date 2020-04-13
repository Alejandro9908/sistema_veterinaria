@extends('layouts.admin')
@section('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Usuarios  <a href ="usuario/create"><button class = "btn btn-success">Nuevo</button></a>    </h3>
		@include('acceso.usuario.search')
	</div>
</div>


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			
			<table class= "table table-striped table-bordered table-consensed table-hover">
				<thead>
					<th>Id</th>
					<th>DPI</th>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>Fecha_nacimiento</th>
					<th>Fecha_inicio</th>
					<th>Telefono</th>
					<th>Correo</th>
					<th>Direccion</th>
					<th>Cargo</th>
					<th>Permisos</th>
					<th>Nick</th>
					<th>Contrasenia</th>
					<th>Fecha_commit</th>
					<th>Opciones</th>
				</thead>
				@foreach ($usuarios as $cat)
				<tr>
					<td>{{ $cat->id_usuario}}</td>
					<td>{{ $cat->dpi}}</td>
					<td>{{ $cat->nombres}}</td>
					<td>{{ $cat->apellidos}}</td>
					<td>{{ $cat->fecha_nacimiento}}</td>
					<td>{{ $cat->fecha_inicio}}</td>
					<td>{{ $cat->telefono}}</td>
					<td>{{ $cat->correo}}</td>
					<td>{{ $cat->direccion}}</td>
					<td>{{ $cat->cargo}}</td>
					<td>{{ $cat->permisos}}</td>
					<td>{{ $cat->nick}}</td>
					<td>{{ $cat->contrasenia}}</td>
					<td>{{ $cat->fecha_commit}}</td>

					<td>
						<a href="{{URL::action('UsuarioController@edit',$cat->id_usuario)}}"><button class = "btn btn-info">Editar</button></a>
						<a href=""><button class= "btn btn-danger">Eliminar</button></a>
					</td>
					
				</tr>
				@endforeach

			</table>

		</div>


		{{$usuarios->render()}}


	</div>

</div>














@endsection
