{!! Form::open(array('url'=>'acceso/usuario','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}

<div class="form-group">
	<div class="input-group">
		<input type="text" class="form-control" name="searchText" placeholder="Buscar Usuario" value="{{$searchText}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-succes">Buscar</button>
		</span>
	</div>
</div>

{{Form::close()}}

