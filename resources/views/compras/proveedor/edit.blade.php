@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Proveedor:</h3>
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
	{!!Form::model($proveedor,['method'=>'PATCH','route'=>['compras.proveedor.update',$proveedor->id_proveedor],'files'=>'true'])!!}
    {{Form::token()}}
    <div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="nit">Nit</label>
            	<input type="text" name="nit" required value="{{$proveedor->nit}}" class="form-control" placeholder="Nit de la empresa">
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="razon_social">Nombre</label>
            	<input type="text" name="razon_social" required value="{{$proveedor->razon_social}}" class="form-control" placeholder="Nombres de la empresa">
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="descripcion">Descripcion</label>
            	<input type="text" name="descripcion" required value="{{$proveedor->descripcion}}" class="form-control" placeholder="Descripcion..(opcional)">
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="telefono">Teléfono</label>
            	<input type="text" name="telefono" required value="{{$proveedor->telefono}}" class="form-control" placeholder="Número">
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="correo">Correo</label>
            	<input type="text" name="correo" value="{{$proveedor->correo}}" class="form-control" placeholder="Correo electronico">
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="pagina_web">Página Web</label>
            	<input type="text" name="pagina_web" value="{{$proveedor->pagina_web}}" class="form-control" placeholder="Pagina web de la empresa">
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="direccion">Dirección</label>
            	<input type="text" name="direccion" value="{{$proveedor->direccion}}" class="form-control" placeholder="Direccion de la empresa">
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