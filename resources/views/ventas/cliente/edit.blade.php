@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Cliente:</h3>
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
		</div>
	</div>
	{!!Form::model($cliente,['method'=>'PATCH','route'=>['ventas.cliente.update',$cliente->id_cliente],'files'=>'true'])!!}
    {{Form::token()}}
    <div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="dpi">DPI</label>
            	<input type="text" name="dpi" required value="{{$cliente->dpi}}" class="form-control" placeholder="Numero único de identificacion">
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="nombres">Nombres</label>
            	<input type="text" name="nombres" required value="{{$cliente->nombres}}" class="form-control" placeholder="Nombres del cliente">
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="apellidos">Apellidos</label>
            	<input type="text" name="apellidos" required value="{{$cliente->apellidos}}" class="form-control" placeholder="Apellidos del cliente">
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="telefono">Teléfono</label>
            	<input type="text" name="telefono" required value="{{$cliente->telefono}}" class="form-control" placeholder="Número">
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="correo">Correo</label>
            	<input type="text" name="correo" value="{{$cliente->correo}}" class="form-control" placeholder="Correo electronico">
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="direccion">Dirección</label>
            	<input type="text" name="direccion" value="{{$cliente->direccion}}" class="form-control" placeholder="Direccion del cliente">
            </div>
		</div>  
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
		</div>
                 
	{!!Form::close()!!}		
            
	
@endsection