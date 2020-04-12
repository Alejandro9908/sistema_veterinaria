@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Articulo:</h3>
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
	{!!Form::model($producto,['method'=>'PATCH','route'=>['producto.producto.update',$producto->id_producto],'files'=>'true'])!!}
    {{Form::token()}}
    <div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" required value="{{$producto->nombre}}" class="form-control">
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="nombre">Categoria</label>
            	<select name="id_categoria" class="form-control">
					@foreach ($categorias as $cat)
						@if ($cat->id_categoria == $producto->id_categoria)
						<option value="{{$cat->id_categoria}}" selected>{{$cat->nombre_categoria}}</option>
						@else
						<option value="{{$cat->id_categoria}}" >{{$cat->nombre_categoria}}</option>
						@endif
					@endforeach
				</select>
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="descripcion">Descripción</label>
            	<input type="text" name="descripcion" value="{{$producto->descripcion}}" class="form-control">
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="stock">Stock</label>
            	<input type="text" name="stock" value="{{$producto->stock}}" class="form-control">
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="precio_venta">Precio Unitario</label>
            	<input type="text" name="precio_venta" value="{{$producto->precio_venta}}" class="form-control">
            </div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="imagen">Imagen</label>
				<input type="file" name="imagen" class="form-control">
				@if(($producto->imagen)!="")
					<img src="{{asset('/imagenes/productos/'.$producto->imagen)}}" height="100px" width="100px" class="img-thumbnail">
				@endif
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