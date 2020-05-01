@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Venta</h3>
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
	{!!Form::open(array('url'=>'ventas/venta','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
	{{Form::token()}}
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-group">
            	<label for="cliente">Cliente</label>
            	<select name="id_cliente" id="id_cliente" class="form-control selectpicker" data-live-search="true">
					@foreach ($clientes as $cli)
						<option value="{{$cli->id_cliente}}">{{$cli->cliente}}</option>
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
						<select name="_id_producto" id="_id_producto" class="form-control selectpicker" data-live-search="true">
							@foreach ($productos as $prod)
								<option value="{{$prod->id_producto}}_{{$prod->stock}}_{{$prod->precio_venta}}">{{$prod->producto}}</option>
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
						<label for="stock">Stock</label>
            			<input type="number" disabled name="_stock" id="_stock" class="form-control" placeholder="cantidad">
            		</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
						<label for="precio_venta">Precio de Venta</label>
            			<input type="number" disabled name="_precio_venta" id="_precio_venta" class="form-control" placeholder="precio">
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
						<input type="hidden" name="total_venta" id="total_venta">
            		</div>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>PRODUCTO</th>
							<th>CANTIDAD</th>
							<th>PRECIO VENTA</th>
							<th>SUBTOTAL</th>
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
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<input type="text" style="visibility:hidden" name="id_usuario" class="form-control" value="{{ Auth::user()->id_usuario}}">
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

		$("#_id_producto").change(mostrarValoresProducto);
		//mostrar valores del producto seleccionado
		function mostrarValoresProducto(){
			datos = document.getElementById('_id_producto').value.split('_');
			$("#_stock").val(datos[1]);
			$("#_precio_venta").val(datos[2]);
		}
		
		function agregar(){
			datos = document.getElementById('_id_producto').value.split('_');
			
			id_prodcuto=datos[0];
			producto=$("#_id_producto option:selected").text();
			cantidad=$("#_cantidad").val();
			precio_venta=$("#_precio_venta").val();
			stock=$("#_stock").val();

			if(id_prodcuto!="" && cantidad!="" && cantidad>0 &&
			 precio_venta!=""){
				subtotal[contador]=(cantidad*precio_venta);
				total = total + subtotal[contador];
				var fila='<tr class="selected" id="fila'+contador+'"><td><input type="hidden" name="id_producto[]" value="'+id_prodcuto+'">'+producto+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_venta[]" value="'+precio_venta+'"></td><td>'+subtotal[contador]+'</td><td><button type"button" class="btn btn-danger" onClick="eliminar('+contador+');">Quitar</button></td></tr>';                              
				contador++;
				limpiar();
				$("#total").html(total);
				$("#total_venta").val(total)
				verificar();
				$("#detalles").append(fila);
			}else{
				alert("error al agregar productos, verifica que todos los campos esten llenos");
			}
		}

		function limpiar(){
			$("#_cantidad").val("");
			$("#_stock").val("");
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
			$("#total_venta").val(total)
			$("#fila"+index).remove();
			verificar();
		}
	</script>
@endpush
@endsection