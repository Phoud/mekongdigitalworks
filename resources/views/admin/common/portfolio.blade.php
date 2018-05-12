@extends('admin.common.main')
@section('title','Portfolio')
@section('content')

<div class="wrapper">
  <div class="content-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<form method="post" action="{{route('admin.portfolio.store')}}" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<label>Website Image</label>
				<input type="file" name="website" accept="image/*">
				<label>Company Name</label>
					<input type="text" name="company" class="form-control">
					<label>Web Address</label>
					<input type="text" name="address" class="form-control">
					<br>
					<button class="btn btn-success" type="submit">Save</button>
					<br>
					<br>
					<br>
				</form>
			</div>

			@foreach($portfolio as $show)
			<div class="col-md-2 col-md-offset-1">
			
			<form method="post" action="{{route('admin.portfolio.delete',$show->id)}}" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
					<img src="{{url('/')}}/images/portfolios/{{$show->image_name}}" style="max-height: 70px;">
					<h4>{{$show->company_name}}</h4>
					<button class="btn btn-danger" type="submit">Delete</button>
					<input type="hidden" name="_method" value="delete">
				</form>
				
			</div>
			@endforeach
		</div>
	</div>
  </div>
  </div>

  @endsection