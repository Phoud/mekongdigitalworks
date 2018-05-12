@extends('admin.common.main')
@section('title','Services')
@section('content')
<div class="wrapper">
  <div class="content-wrapper">
	<div class="col-md-12">
		<div class="page-header">
		<h3>Service upload</h3>
		</div>
		<form action="{{route('admin.homepage_service.store')}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
			<label>Logo Name</label>
			<input class="form-control" type="text" name="logo_name" required="">
			<label>Service Name</label>
			<input class="form-control" type="text" name="service_name" required="">
			<label>Discription</label>
			<textarea class="form-control" name="service_discription" required=""></textarea>
			<hr>
			<button class="btn btn-success" type="submit">Submit</button>
		</form>
		<hr>
	</div>
	
	@foreach($service_name as $show)
	 <div class="col-md-3">
  	<h4>{{$show->service_name}}</h4>
  	<div class="col-md-3">
  	<form method="post" action="{{route('admin.h_service_delete.store', $show->id)}}">
  	<button type="submit" class="btn btn-danger btn-sm">Delete</button>
  	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<input type="hidden" name="_method" value="delete">
  	</form>
  	</div>
  	<div class="col-md-3">
  	<form>
	<a href="{{route('admin.homepage_service_edit.edit',$show->id)}}" class="btn btn-warning btn-sm">Edit</a>
  	</form>
  	</div>
  </div>
 	@endforeach
  </div>
 

  </div>

  @endsection