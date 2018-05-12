@extends('admin.common.main')
@section('title','Package')
@section('content')

<div class="wrapper">
  <div class="content-wrapper">
  <div class="container">
	<form action="{{route('admin.packagecat.store')}}" method="post" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
		<div class="col-md-11">
			<label>Package Name</label>
			<input type="text" class="form-control" name="packagecat">
			<br>
			<input type="file" name="image" accept="image/*">
			<br>
			<button type="submit" class="btn btn-success btn-sm pull-left">Save</button>
		</div>
	</form>
	<br>

	
	
	<div class="col-md-8">
	<div class="page-header">Package Category Name</div>
	@foreach($display as $show)
	<form action="{{route('admin.packagecat.update', $show->id)}}" method="post" enctype="multipart/form-data">
		<input class="form-control" type="text" name="categoryname" value="{{$show->name}}">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<br>
		<input type="file" name="image" accept="image/*">
		<button class="btn btn-warning btn-sm">Edit</button>

	</form>
	<br>
	<form action="{{route('admin.packagecat.delete',$show->id)}}" method="post">
	<button class="btn btn-danger btn-sm" type="submit">Delete</button>
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<input type="hidden" name="_method" value="delete">
	</form>
	
	@endforeach
	
	</div>
  </div>
  </div>
</div>
  @endsection