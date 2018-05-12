@extends('admin.common.main')
@section('title','Partners')
@section('content')
<div class="wrapper">
  <div class="content-wrapper">
	<div class="col-md-12">
		<h3>Partners and Customers</h3>
		<br>
		<form action="{{route('admin.partners.store')}}" enctype="multipart/form-data" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
			<label>Background cover</label>
			<input type="file" name="background" accept="image/*">
			<br>
			<label>Partner and customer logo</label>
			<input type="file" name="logo" accept="image/*">
			<br>
			<button class="btn btn-success btn-sm" type="submit">Save</button>

		</form>
	</div>
	<br>
	@foreach($partner_logo_show as $display)
	<div class="col-md-3">
		<img src="{{url('/')}}/images/partners/{{$display->image_name}}" style="max-height: 70px;">
		<div class="col-md-4">
		<form action="{{route('admin.partner.store', $display->id)}}" method="post">
		<button class="btn btn-danger btn-sm" type="submit">Delete</button>
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="_method" value="delete">
		</form>
		</div>
	</div>
	@endforeach
  </div>
  </div>
  @endsection