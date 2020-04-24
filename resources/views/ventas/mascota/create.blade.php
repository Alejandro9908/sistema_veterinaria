@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Mascota</h3>
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
	{!!Form::open(array('url'=>'ventas/mascota','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
	{{Form::token()}}
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="nombre_mascota">Nombre de la Mascota</label>
            	<input type="text" name="nombre_mascota" required value="{{old('nombre_mascota')}}" class="form-control" placeholder="Nombre">
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="cliente">Cliente</label>
            	<select name="id_cliente" id="id_cliente" class="form-control selectpicker" data-live-search="true">
					@foreach ($clientes as $cli)
						<option value="{{$cli->id_cliente}}">{{$cli->cliente}}</option>
					@endforeach
				</select>
            </div> 
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="pedigri">Pedigri</label>
            	<select name="pedigri" id="pedigri" class="form-control selectpicker" data-live-search="true">
						<option value="NO">No</option>
						<option value="SI">Si</option>
				</select>
            </div> 
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="sexo">Genero</label>
            	<select name="sexo" id="sexo" class="form-control selectpicker" data-live-search="true">
						<option value="MACHO">Macho</option>
						<option value="HEMBRA">Hembra</option>
				</select>
            </div> 
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="raza">Raza</label>
            	<input type="text" name="raza" required value="{{old('raza')}}" class="form-control" >
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="especie">Especie</label>
            	<input type="text" name="especie" required value="{{old('especie')}}" class="form-control">
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="color_primario">Color Primario</label>
            	<input type="text" name="color_primario" required value="{{old('color_primario')}}" class="form-control" >
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="color_secundario">Color Secundario</label>
            	<input type="text" name="color_secundario" value="{{old('color_secundario')}}" class="form-control">
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="observacion">Observación</label>
            	<input type="text" name="observacion" value="{{old('observacion')}}" class="form-control">
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="fecha_nacimiento">Fecha de nacimiento</label>
            	<input type="date"  name="fecha_nacimiento" class="form-control" placeholder="YYYY-MM-DD">
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