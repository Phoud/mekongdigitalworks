@extends('admin.common.main')
@section('title','Package')
@section('content')

<div class="wrapper">
  <div class="content-wrapper">
  <div class="container">
	<form action="{{route('admin.package.store')}}" method="post">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
		<div class="col-md-7">
			<label>Price</label>
			<input class="form-control" type="text" name="price">
			<label>Web category</label>
			<select class="form-control" name="web">
			@foreach($display as $show)
				<option value="{{$show->id}}">{{$show->name}}</option>
				@endforeach
			</select>
			<label>Type</label>
			<select class="form-control" name="type">
				<option>basic</option>
				<option>standard</option>
				<option>premium</option>
			</select>
			<label>Package Detail</label>
			<input class="form-control" type="text" name="package_name" placeholder="Ex:1 domain^6 months quarantee...">
			<br>
			<button type="submit" class="btn btn-success btn-sm pull-left">Save</button>
		</div>
	</form>
	<br>
	<br>
	<div class="col-md-12">
	<h4>Package Details</h4>
	@foreach($package as $d)
	<form action="{{route('admin.package.update',$d->id)}}" method="post">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
		<div class="col-md-7">
		<br>
			<label>Price</label>
			<input class="form-control" type="text" name="price" value="{{$d->price}}">
			<label>Web category</label>
			<select class="form-control" name="web">
			@foreach($display as $show)
				<option value="{{$show->id}}" {{$d->cat_id==$show->id ? 'selected':""}}>{{$show->name}}</option>
				@endforeach
			</select>
			<label>Type</label>
			<select class="form-control" name="type">
				<option {{$d->type=='basic' ? 'selected':""}}>basic</option>
				<option {{$d->type=='standard' ? 'selected':""}}>standard</option>
				<option {{$d->type=='premium' ? 'selected':""}}>premium</option>
			</select>
			<label>Package Detail</label>
			<input class="form-control" type="text" name="package_name" value="{{$d->package_name}}">
			<br>
			<button type="submit" class="btn btn-success btn-sm pull-left">Update</button>
		</div>
	</form>
	<div class="col-md-12">
	<form action="{{route('admin.package.delete',$d->id)}}" method="post">
		<button class="btn btn-danger btn-sm">Delete</button>
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="_method" value="delete">
	</form>
	</div>
	<br>
	@endforeach
	</div>
  </div>
  </div>
</div>
  @endsection