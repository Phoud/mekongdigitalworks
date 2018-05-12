@extends('admin.common.main')
@section('title','Services')
@section('content')
<div class="wrapper">
  <div class="content-wrapper">
	<div class="col-md-12">
		<div class="page-header">
		<h3>Service upload</h3>
		</div>
		<form action="{{route('admin.service_edit.store', $service_show->id)}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
			<label>Logo Name</label>
			<input class="form-control" type="text" name="logo_name" required="" value="{{$service_show->logo_name}}">
			<label>Service Name</label>
			<input class="form-control" type="text" name="service_name" required="" value="{{$service_show->service_name}}">
			<label>Discription</label>
			<textarea class="form-control" name="service_discription" required="" value="">{{$service_show->service_discription}}</textarea>
			<hr>
			<button class="btn btn-success" type="submit">Update</button>
		</form>
		<hr>
	</div>
  </div>
 

  </div>

  @endsection