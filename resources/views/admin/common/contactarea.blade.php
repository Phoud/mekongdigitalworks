@extends('admin.common.main')
@section('title','Contactarea')
@section('content')

<div class="wrapper">
  <div class="content-wrapper">
@include('partial.alert')
	<form method="post" action="{{route('admin.contactarea.store')}}" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<div class="col-md-11">
		<label>Email</label>
		<input type="email" name="email" class="form-control">
		<label>Phone number</label>
		<input type="text" name="phone1" class="form-control">
		<label>Secondary phone number</label>
		<input type="text" name="phone2" class="form-control">
		<br>
		</div>
		<div class="col-md-2 col-sm-2 col-xs-2">
		<button type="submit" class="btn btn-success btn-sm">Save</button>
		</div>
	</form>

	<form action="{{route('admin.contactarea.update',$contactshow->id)}}" method="post">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<div class="col-md-11">
		<label>Email</label>
		<input type="email" name="email" class="form-control" value="{{$contactshow->email}}">
		<label>Phone number</label>
		<input type="text" name="phone1" class="form-control" value="{{$contactshow->phone_number1}}">
		<label>Secondary phone number</label>
		<input type="text" name="phone2" class="form-control" value="{{$contactshow->phone_number2}}">
		<br>
		</div>
		<div class="col-md-2 col-sm-2 col-xs-2">
		<button type="submit" class="btn btn-warning btn-sm">Update</button>
		</div>
	</form>

</div>
</div>
@endsection