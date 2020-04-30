@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Consulta</h3>
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
	{!!Form::open(array('url'=>'ventas/consulta','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
	{{Form::token()}}
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-group">
            	<label for="mascota">Mascota</label>
            	<select name="id_mascota" id="id_mascota" class="form-control selectpicker" data-live-search="true">
					@foreach ($mascotas as $mas)
						<option value="{{$mas->id_mascota}}">{{$mas->mascota}}</option>
					@endforeach
				</select>
			</div>
		</div> 	
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
            	<label for="tipo_comprobante">Tipo de comprobante</label>
            	<select name="tipo_comprobante" id="tipo_comprobante" class="form-control">
						<option value="RECIBO">RECIBO</option>
				</select>
            </div> 
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
            	<label for="serie">Serie de comprobante</label>
            	<input type="text" name="serie" value="A" class="form-control" placeholder="Serie" readonly="readonly">
            </div>
		</div>
	</div>
	<div class="row">	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="sintomas">Sintomas</label>
            	<input type="text" name="sintomas" id="sintomas" class="form-control" placeholder="Sintomas">
            </div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label for="precio_consulta">Precio</label>
            	<input type="text" name="precio_consulta" id="precio_consulta" class="form-control" placeholder="Precio de Consulta">
            </div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label for="fecha_programada">Fecha Programada</label>
            	<input type="date" name="fecha_programada" id="fecha_programada" min="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>"  class="form-control" placeholder="YYY-MM-DD">
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