@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Ingreso</h3>
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
	{!!Form::open(array('url'=>'compras/compra','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
	{{Form::token()}}
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-group">
            	<label for="proveedor">Proveedor</label>
            	<select name="id_proveedor" id="id_proveedor" class="form-control selectpicker" data-live-search="true">
					@foreach ($proveedores as $prov)
						<option value="{{$prov->id_proveedor}}">{{$prov->razon_social}}</option>
					@endforeach
				</select>
            </div> 
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
            	<label for="tipo_comprobante">Tipo de comprobante</label>
            	<select name="tipo_comprobante" id="tipo_comprobante" class="form-control">
						<option value="Recibo">Recibo</option>
						<option value="Factura">Factura</option>
				</select>
            </div> 
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
            	<label for="serie">Serie de comprobante</label>
            	<input type="text" name="serie" value="{{old('serie')}}" class="form-control" placeholder="Serie">
            </div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
            	<label for="numero_comprobante">Número de comprobante</label>
            	<input type="text" name="numero_comprobante" required value="{{old('numero_comprobante')}}" class="form-control" placeholder="Numero">
            </div>
		</div>	
	</div>

	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-body">
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
						<label for="producto">Productos</label>
						<select name="id_producto" id="id_producto" class="form-control selectpicker" data-live-search="true">
							@foreach ($productos as $prod)
								<option value="{{$prod->id_producto}}">{{$prod->nombre}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
						<label for="cantidad">Cantidad</label>
            			<input type="number" name="_cantidad" id="_cantidad" class="form-control" placeholder="cantidad">
            		</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
						<label for="precio_compra">Precio de Compra</label>
            			<input type="number" name="_precio_compra" id="_precio_compra" class="form-control" placeholder="precio">
            		</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
						<label for="precio_venta">Precio de Venta</label>
            			<input type="number" name="_precio_venta" id="_precio_venta" class="form-control" placeholder="precio">
            		</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
						<button type="button" id="agregar" class="btn btn-primary">Agregar</button>
            		</div>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>PRODUCTO</th>
							<th>CANTIDAD</th>
							<th>PRECIO COMPRA</th>
							<th>PRECIO VENTA</th>
							<th>SUBTOTAL</th>
							<th>OPCIONES</th>
						</thead>
							<th></th>
							<th></th>
							<th></th>
							<th>TOTAL:</th>
							<th>0.00</th>
							<th></th>
						<tfoot>

						</tfoot>
						<tbody>

						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div>
	
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<input type="hidden" name="_token" value="{{csrf_token()}}"></input>
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
	</div>
    
			{!!Form::close()!!}		
@endsection