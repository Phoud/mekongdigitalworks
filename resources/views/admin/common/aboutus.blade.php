@extends('admin.common.main')
@section('title','Services')
@section('content')
@include('partial.alert')
<div class="wrapper">
  <div class="content-wrapper">
	<div class="container">
	<div class="col-md-10">
		<form action="{{route('admin.aboutus.store')}}" method="post" enctype="multipart/form-data">
		<div class="page-header">
		<h3>About Our Company</h3>
		</div>
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<label>Choose a photo</label>
			<input type="file" name="aboutpic" accept="image/*" required="">
			<label>Company Name</label>
			<input class="form-control" type="text" name="company_name" required="">
			<label>Company information</label>
			<textarea class="form-control" type="text" name="company_info" required=""></textarea>
			<br>
			<button class="btn btn-success" type="submit">Save</button>
		</form>
		</div>
		<hr>
		@foreach($about_display as $display)
		<div class="col-md-3">
		<form method="post" action="{{route('admin.aboutdelete.store', $display->id)}}">
			<img src="{{url('/')}}/images/{{$display->profile_image_name}}" class="img-responsive" style="max-height: 100px;" />
			<h4>{{$display->company_name}}</h4>
			<button class="btn btn-danger btn-sm" type="submit">Delete</button>
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<input type="hidden" name="_method" value="delete">
			</form>
		</div>
		@endforeach
	</div>
  </div>
  </div>
  @endsection