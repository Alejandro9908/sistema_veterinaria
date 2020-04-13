@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Usuario</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'acceso/usuario','method'=>'POST','autocomplete'=>'off'))!!}

            {{Form::token()}}

            <div class="form-group">
            	<label for="dpi">DPI</label>
            	<input type="text" name="dpi" class="form-control" placeholder="Documento Personal de Identificación">
            </div>

            <div class="form-group">
            	<label for="nombres">Nombres</label>
            	<input type="text" name="nombres" class="form-control" placeholder="Primer, segundo y tercer nombre">
            </div>

            <div class="form-group">
            	<label for="apellidos">Apellidos</label>
            	<input type="text" name="apellidos" class="form-control" placeholder="Apellidos">
            </div>

            <div class="form-group">
            	<label for="fecha_nacimiento">Fecha de nacimiento</label>
            	<input type="date"  name="fecha_nacimiento" class="form-control" value="1999-01-01">
            </div>

            <div class="form-group">
            	<label for="fecha_inicio">Fecha de inicio</label>
            	<input type="date" name="fecha_inicio" class="form-control" placeholder="YYYY-MM-DD">
            </div>

           
            <div class="form-group">
            	<label for="telefono">No. Telefono</label>
            	<input type="text" name="telefono" class="form-control" placeholder="Número de telefono">
            </div>

            <div class="form-group">
            	<label for="correo">Correo Electrónico</label>
            	<input type="text" name="correo" class="form-control" placeholder="Correo Electrónico">
            </div>

            <div class="form-group">
            	<label for="direccion">Dirección</label>
            	<input type="text" name="direccion" class="form-control" placeholder="Dirección">
            </div>

            <div class="form-group">
            	<label for="cargo">Cargo</label>
            	<input type="text" name="cargo" class="form-control" placeholder="Cargo">
            </div>

            

            <div class="form-group">
            <label for="permisos">Permisos</label>
            <select name="permisos" class="form-control">

			<option>Administrador</option>
			<option>Vendedor</option>
			<option>Invitado</option>
			</select>
            </div>

           

        
             <div class="form-group">
            	<label for="nick">Nickname o Nombre de Usuario</label>
            	<input type="text" name="nick" class="form-control" placeholder="Nickname o Nombre de Usuario">
            </div>

            <div class="form-group">
            	<label for="contrasenia">Contraseña</label>
            	<input type="password" name="contrasenia" class="form-control" placeholder="Contraseña">
            </div>

            <div class="form-group">
            	<label for="fecha_commit">Fecha commit</label>
            	<input type="date" name="fecha_commit" class="form-control" placeholder="YYYY-MM-DD">
            </div>



            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection