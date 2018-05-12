@extends('admin.common.main')
@section('title','Logo')
@section('content')

<div class="wrapper">
  <div class="content-wrapper">
	<h2>Company Information</h2>
	<br>
	<div class="col-md-10 md-offset-2">
	<form action="{{route('admin.information.store')}}" method="post" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<label>Image</label>
	<input type="file" name="image" accept="image/*" required="">
	<label>Company Slogan</label>
	<input type="text" name="slogan" class="form-control" required="">
	<label>Discription</label>
	<input type="text" name="discription" class="form-control" required="">
	<br>
	<button class="btn btn-primary" type="submit">Save</button>
	</form>
	</div>
  </div>
  </div>

  @endsection