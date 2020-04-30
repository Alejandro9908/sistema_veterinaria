@extends ('layouts.admin')
@section ('contenido')
	
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
            	<label for="mascota">Mascota</label>
            	<p>{{$ventaServicio->nombre_mascota}}</p>
            </div> 
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="cliente">Cliente</label>
            	<p>{{$ventaServicio->cliente}}</p>
            </div> 
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
            	<label for="tipo_comprobante">Tipo de comprobante</label>
            	<p>{{$ventaServicio->tipo_comprobante}}</p>
            </div> 
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
            	<label for="serie">Serie de comprobante</label>
            	<p>{{$ventaServicio->serie}}</p>
            </div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
            	<label for="numero_comprobante">Número de comprobante</label>
            	<p>{{$ventaServicio->id_venta_servicio}}</p>
            </div>
		</div>	
	</div>

	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-body">				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>SERVICIO</th>
							<th>DESCRIPCION</th>
							<th>FECHA PROGRAMADA</th>
							<th>PRECIO</th>
							<th>ESTADO</th>
						</thead>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>	
						<tfoot>

						</tfoot>
						<tbody>
							@foreach($detalles as $detalle)
								<tr>
									<td>{{$detalle->servicio}}</td>
									<td>{{$detalle->descripcion}}</td>
									<td>{{$detalle->fecha_programada}}</td>
									<td>{{$detalle->precio_venta}}</td>
								</tr>	
							@endforeach
						</tbody>
					</table>
				</div>

				<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
					<div class="form-group">
						
            		</div>
				</div>
				
				<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
					<div class="form-group">
						<h4><b>Total:</b></h4>
            		</div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
					<div class="form-group">
						<h4 id="total">{{$ventaServicio->total}}</h4>
            		</div>
				</div>

			</div>
		</div>
	</div>

@endsection