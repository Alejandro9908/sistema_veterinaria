{!! Form::open(array('url'=>'ventas/ventaServicio','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}

<div class="form-group">
	<div class="input-group">
		<input type="text" class="form-control" name="searchText" placeholder="Buscar Proveedor" value="{{$searchText}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-succes">Buscar</button>
		</span>
	</div>
</div>

{{Form::close()}}



