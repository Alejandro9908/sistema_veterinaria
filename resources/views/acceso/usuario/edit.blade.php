@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Usuario:</h3>
            <hr>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($usuario,['method'=>'PATCH','route'=>['acceso.usuario.update',$usuario->id_usuario]])!!}
            {{Form::token()}}


            <div class="form-group">
            	<label for="dpi">DPI</label>
            	<input type="text" name="dpi" class="form-control" value="{{$usuario->dpi}}" placeholder="Documento Personal de Identificación">
            </div>

            <div class="form-group">
            	<label for="nombres">Nombres</label>
            	<input type="text" name="nombres" class="form-control" value="{{$usuario->nombres}}" placeholder="Primer, segundo y tercer nombre">
            </div>

            <div class="form-group">
            	<label for="apellidos">Apellidos</label>
            	<input type="text" name="apellidos" class="form-control" value="{{$usuario->apellidos}}" placeholder="Apellidos">
            </div>

            <div class="form-group">
            	<label for="fecha_nacimiento">Fecha de nacimiento</label>
            	<input type="date" name="fecha_nacimiento" class="form-control" value="{{$usuario->fecha_nacimiento}}">
            </div>

            <div class="form-group">
            	<label for="fecha_inicio">Fecha de inicio</label>
            	<input type="date" name="fecha_inicio" class="form-control" value="{{$usuario->fecha_inicio}}">
            </div>

                <div class="form-group">
            	<label for="telefono">No. Telefono</label>
            	<input type="text" name="telefono" class="form-control" value="{{$usuario->telefono}}" placeholder="telefono">
            </div>

            <div class="form-group">
            	<label for="correo">Correo electrónico</label>
            	<input type="text" name="correo" class="form-control" value="{{$usuario->correo}}" placeholder="Correo electrónico">
            </div>

             <div class="form-group">
            	<label for="direccion">Dirección</label>
            	<input type="text" name="direccion" class="form-control" value="{{$usuario->direccion}}" placeholder="Dirección">
            </div>

            <div class="form-group">
            	<label for="cargo">Cargo</label>
            	<input type="text" name="cargo" class="form-control" value="{{$usuario->cargo}}" placeholder="Cargo">
            </div>

            
            <div class="form-group">
            <label for="permisos">Permisos</label>
            <select name="permisos" class="form-control" value="{{$usuario->permisos}}">
			<option>Administrador</option>
			<option>Vendedor</option>
			<option>Invitado</option>
			<option selected="true" disabled="disabled">{{$usuario->permisos}}</option>
			</select>
            </div>

            <div class="form-group">
            	<label for="nick">Nickname o Nombre de usuario</label>
            	<input type="text" name="nick" class="form-control" value="{{$usuario->nick}}" placeholder="Nickname o Nombre de usuario">
            </div>

            <div class="form-group">
            	<label for="contrasenia">Contraseña</label>
            	<input type="text" name="contrasenia" class="form-control" value="{{$usuario->contrasenia}}" placeholder="Contraseña">
            </div>

           

          


            <hr>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar Cambios</button>
            	<button class="btn btn-default" type="reset">Cancelar</button>
            </div>
                 
			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection