@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Detalles de la Consulta:</h3>
            <hr>
		
		</div>
	</div>
	<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
            	<label for="mascota">Mascota</label>
            	<p>{{$consulta->mascota}}</p>
            </div> 
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="cliente">Cliente</label>
            	<p>{{$consulta->cliente}}</p>
            </div> 
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
            	<label for="tipo_comprobante">Tipo de comprobante</label>
            	<p>{{$consulta->tipo_comprobante}}</p>
            </div> 
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
            	<label for="serie">Serie de comprobante</label>
            	<p>{{$consulta->serie}}</p>
            </div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
            	<label for="numero_comprobante">Número de comprobante</label>
            	<p>{{$consulta->id_consulta}}</p>
            </div>
		</div>
	</div>
	<hr>
	<h4><b>Datos de la Cosulta</b></h4>

	<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="form-group">
            <label for="numero_comprobante">Sintomas</label>
            <p>{{$consulta->sintomas}}</p>
		</div>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="form-group">
            <label for="numero_comprobante">Diagnostico</label>
            <p>{{$consulta->diagnostico}}</p>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
            <label for="numero_comprobante">Fecha Programada</label>
            <p>{{$consulta->fecha_programada}}</p>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
            <label for="numero_comprobante">Precio</label>
            <p>{{$consulta->precio_consulta}}</p>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="numero_comprobante">Estado</label>
			@if($consulta->estado==1)
			<p>ACTIVO</p>
			@endif
			@if($consulta->estado==0)
			<p>ANULADO</p>
			@endif
			@if($consulta->estado==2)
			<p>COMPLETADO</p>
			@endif
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
            <label for="numero_comprobante">Fecha de creacion</label>
            <p>{{$consulta->fecha_commimt}}</p>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
            <label for="numero_comprobante">Usuario</label>
            <p>{{$consulta->nick}}</p>
		</div>
	</div>
                 
	{!!Form::close()!!}		
            
	
@endsection