@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Venta de Servicio</h3>
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
	{!!Form::open(array('url'=>'ventas/ventaServicio','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
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
						<option value="Recibo">Recibo</option>
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
		<div class="panel panel-primary">
			<div class="panel-body">
				<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
					<div class="form-group">
						<label for="servicio">Servicios</label>
						<select name="_id_servicio" id="_id_servicio" class="form-control selectpicker" data-live-search="true">
							@foreach ($servicios as $serv)
								<option value="{{$serv->id_servicio}}_{{$serv->precio_servicio}}_{{$serv->descripcion}}">{{$serv->servicio}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
						<label for="precio_venta">Precio de Venta</label>
            			<input type="number" disabled name="_precio_venta" id="_precio_venta" class="form-control" placeholder="Precio">
            		</div>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
					<div class="form-group">
						<label for="descripcion">Descripcion</label>
            			<input type="text" disabled name="_descripcion" id="_descripcion" class="form-control" placeholder="Descripcion">
            		</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
						<label for="precio_venta">Fecha Programada</label>
            			<input type="date" name="_fecha_programada" id="_fecha_programada" min="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>"  class="form-control" placeholder="YYY-MM-DD">
            		</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
						<button type="button" id="btnAgregar" class="btn btn-primary">Agregar</button>
            		</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
						<h4 id="total">0.00</h4>
            		</div>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>SERVICIO</th>
							<th>DESCRIPCION</th>
							<th>FECHA PROGRAMADA</th>
							<th>PRECIO</th>
							<th>OPCIONES</th>
						</thead>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
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
	
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="guardar">
			<div class="form-group">
				<input type="hidden" name="_token" value="{{csrf_token()}}"></input>
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
	</div>
	{!!Form::close()!!}
	@push('scripts')
	<script>
		$(document).ready(function(){
			$("#btnAgregar").click(function(){
				agregar();
			});
		});

		var contador=0;
		total=0;
		subtotal=[];
		$("#guardar").hide();

		$("#_id_servicio").change(mostrarValoresProducto);
		//mostrar valores del producto seleccionado
		function mostrarValoresProducto(){
			datos = document.getElementById('_id_servicio').value.split('_');
			$("#_precio_venta").val(datos[1]);
			$("#_descripcion").val(datos[2]);
			
		}
		
		function agregar(){
			datos = document.getElementById('_id_servicio').value.split('_');
			
			id_servicio=datos[0];
			servicio=$("#_id_servicio option:selected").text();
			descripcion=datos[2];
			precio_venta=$("#_precio_venta").val();
			fecha_programada=$("#_fecha_programada").val();

			if(id_servicio!="" && precio_venta!=""){
				subtotal[contador]=(1*precio_venta);
				total = total + subtotal[contador];
				var fila='<tr class="selected" id="fila'+contador+'"><td><input type="hidden" name="id_servicio[]" value="'+id_servicio+'">'+servicio+'</td><td>'+descripcion+'</td><td><input type="date" name="fecha_programada[]" value="'+fecha_programada+'"></td><td><input type="number" name="precio_venta[]" value="'+precio_venta+'"></td><td><button type"button" class="btn btn-danger" onClick="eliminar('+contador+');">Quitar</button></td></tr>';                              
				contador++;
				limpiar();
				$("#total").html(total);
				verificar();
				$("#detalles").append(fila);
			}else{
				alert("error al agregar productos, verifica que todos los campos esten llenos");
			}
		}

		function limpiar(){
			$("#_descripcion").val("");
			$("#_precio_venta").val("");
		}

		function verificar(){
			if(total>0){
				$("#guardar").show();
			}else{
				$("#guardar").hide();
			}
		}

		function eliminar(index){
			total = total - subtotal[index];
			$("#total").html(total);
			$("#fila"+index).remove();
			verificar();
		}
	</script>
	@endpush
@endsection