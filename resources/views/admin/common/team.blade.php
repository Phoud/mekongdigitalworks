@extends('admin.common.main')
@section('title','The Team')
@section('content')

<div class="wrapper">
  <div class="content-wrapper">
  <div class="container">
  	<div class="col-md-10">
  		<h3>The Team</h3>
  		<form action="{{route('admin.team.post')}}" method="post" enctype="multipart/form-data">
  		<input type="hidden" name="_token" value="{{csrf_token()}}">
  			<label>Profile Photo</label>
  			<input type="file" name="profile" required="">
  			<label>Name and Surname</label>
  			<input type="text" name="name" class="form-control" required="">
        <label>Position</label>
        <input type="text" name="position" class="form-control" required="">
  			<label>Email</label>
  			<input type="email" name="email" class="form-control" required="">
  			<label>Phone Number</label>
  			<input type="text" name="phone" class="form-control" required="">
  			<label>Facebook url</label>
  			<input type="text" name="facebook" class="form-control" required="">
  			<br>
  			<button class="btn btn-primary" type="submit">Save</button>
  			<br>
  			<br>
  		</form>
  	</div>
  	@foreach($team as $t)
  	<form method="post" action="{{route('admin.team.delete',$t->id)}}">
	<div class="col-md-3">
		<img src="{{url('/')}}/images/About/{{$t->profile_name}}" style="max-height: 100px;">
		<br>
		<button class="btn btn-danger btn-sm" type="submit">Delete</button>
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="_method" value="Delete">
	</div>
	</form>
	@endforeach
  	</div>
  	</div>
  </div>
  @endsection