<div class="row">
	<div class="col s6">
		@if(Session::has('success'))
		<div class="alert alert-success" role="alert">
		<hr>
		<strong>Success:</strong><br>{{ Session::get('success') }}
		</div> 
		@endif
		@if(count($errors) > 0)
		<div class="alert alert-danger" role="alert">
		<strong>Errors:</strong>
		<ul>
		@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
		</ul>
		</div>
		@endif
 	</div>
</div>