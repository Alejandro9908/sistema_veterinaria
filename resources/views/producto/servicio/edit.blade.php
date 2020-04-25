@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Servicio:</h3>
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
	{!!Form::model($servicio,['method'=>'PATCH','route'=>['producto.servicio.update',$servicio->id_servicio],'files'=>'true'])!!}
    {{Form::token()}}
    <div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="nombre_servicio">Nombre</label>
            	<input type="text" name="nombre_servicio" required value="{{$servicio->nombre_servicio}}" class="form-control" placeholder="Nombre del servicio">
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="precio_servicio">Precio</label>
            	<input type="text" name="precio_servicio" value="{{$servicio->precio_servicio}}" class="form-control" placeholder="Precio de venta">
            </div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-group">
            	<label for="descripcion">Descripción</label>
            	<input type="text" name="descripcion" value="{{$servicio->descripcion}}" class="form-control" placeholder="Descripcion...(opcional)">
            </div>
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