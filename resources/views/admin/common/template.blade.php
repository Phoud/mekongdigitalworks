@extends('admin.common.main')
@section('title','Template')
@section('content')


<div class="wrapper">
  <div class="content-wrapper">
  <div class="container">
  	<div class="col-md-10">
  		<div class="page-header">Template Upload</div>
	<form action="{{route('admin.template.post')}}" method="post" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
		<label>Template url</label>
		<input type="text" name="template_url" class="form-control" required="">
		<label>Package Category</label>
		<select class="form-control" name="cate">
		@foreach($pack as $p)
			<option value="{{$p->id}}">{{$p->name}}</option>
		@endforeach
		</select>
	<label>Template Image</label>
	<input type="file" name="image" accept="image/*">
	<br>
	<button type="submit" class="btn btn-primary">Save</button>
	</form>
  	</div>

@foreach($template as $t)
	<div class="col-md-10">
  		<div class="page-header">Template Update</div>
	<form action="{{route('admin.template.update',$t->id)}}" method="post" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
		<label>Template url</label>
		<input type="text" name="template_url" class="form-control" required="" value="{{$t->template}}">
		<label>Package Category</label>
		<select class="form-control" name="cate">
		@foreach($pack as $p)
			<option value="{{$p->id}}" {{$t->cat_id==$p->id}}>{{$p->name}}</option>
		@endforeach
		</select>
	<label>Template Image</label>
	<input type="file" name="image" accept="image/*">
	<br>
	<div class="col-md-2">
	<button type="submit" class="btn btn-warning">Edit</button>
	</div>
	</form>

	<div class="col-md-2">
	<form>
		
		<button type="submit" class="btn btn-danger">Delete</button>
	</form>
	</div>
  	</div>
@endforeach

  </div>

  </div>
  </div>

  @endsection