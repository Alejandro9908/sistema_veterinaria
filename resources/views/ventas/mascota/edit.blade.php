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
	{!!Form::model($mascota,['method'=>'PATCH','route'=>['ventas.mascota.update',$mascota->id_mascota],'files'=>'true'])!!}
    {{Form::token()}}
    <div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="nombre_mascota">Nombre de la Mascota</label>
            	<input type="text" name="nombre_mascota" required value="{{$mascota->nombre_mascota}}" class="form-control" placeholder="Nombre">
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="cliente">Cliente</label>
            	<select name="id_cliente" id="id_cliente" class="form-control selectpicker" data-live-search="true">
					@foreach ($clientes as $cli)
						<option value="{{$cli->id_cliente}}" {{(isset($mascota->id_cliente)&&$mascota->id_cliente==$cli->id_cliente)?'selected':''}}>{{$cli->cliente}}</option>
					@endforeach
				</select>
            </div> 
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="pedigri">Pedigri</label>
            	<select name="pedigri" id="pedigri" class="form-control selectpicker" data-live-search="true">
						<option value="NO" {{(isset($mascota->pedigri)&&$mascota->pedigri=="NO")?'selected':''}}>NO</option>
						<option value="SI" {{(isset($mascota->pedigri)&&$mascota->pedigri=="SI")?'selected':''}}>SI</option>
				</select>
            </div> 
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="sexo">Genero</label>
            	<select name="sexo" id="sexo" class="form-control selectpicker" data-live-search="true">
						<option value="MACHO" {{(isset($mascota->sexo)&&$mascota->sexo=="MACHO")?'selected':''}}>MACHO</option>
						<option value="HEMBRA" {{(isset($mascota->sexo)&&$mascota->sexo=="HEMBRA")?'selected':''}}>HEMBRA</option>
				</select>
            </div> 
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="raza">Raza</label>
            	<input type="text" name="raza" required value="{{$mascota->raza}}" class="form-control" >
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="especie">Especie</label>
            	<input type="text" name="especie" required value="{{$mascota->especie}}" class="form-control">
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="color_primario">Color Primario</label>
            	<input type="text" name="color_primario" required value="{{$mascota->color_primario}}" class="form-control" >
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="color_secundario">Color Secundario</label>
            	<input type="text" name="color_secundario" value="{{$mascota->color_secundario}}" class="form-control">
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="observacion">Observación</label>
            	<input type="text" name="observacion" value="{{$mascota->observacion}}" class="form-control">
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="fecha_nacimiento">Fecha de nacimiento</label>
            	<input type="date"  name="fecha_nacimiento" class="form-control" value="{{$mascota->fecha_nacimiento}}" placeholder="YYYY-MM-DD">
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