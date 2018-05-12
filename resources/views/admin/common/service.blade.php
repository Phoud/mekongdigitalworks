@extends('admin.common.main')
@section('title', 'Service')
@section('content')

<div class="wrapper">
  <div class="content-wrapper">
    <h3>Services</h3>
    <br>
    <br>
	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<form action="{{route('admin.service.store')}}" method="post" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
					<label>Image 1</label>
					<input type="file" name="pic1" accept="image/*">
					<label>Image 2</label>
					<input type="file" name="pic2" accept="image/*">
					<label>Discription 1</label>
					<textarea class="form-control" type="text" name="discription1"></textarea>
					<label>Discription 2</label>
					<textarea class="form-control" type="text" name="discription2"></textarea>
					<br>
					<button type="submit" class="btn btn-success">Save</button>
				</form>
				<br>
			</div>
			
					<label>Service</label>
					@foreach($ser_action as $s)
					<form action="{{route('admin.service.delete', $s->id)}}" method="post" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<div class="col-md-3">
					<img src="{{url('/')}}/images/services/{{$s->image_name}}" style="max-height: 90px;">
					<br>
					<br>
					<button type="submit" class="btn btn-danger">Delete</button>
					<input type="hidden" name="_method" value="delete">

					</div>
					</form>
					@endforeach
				
			
		</div>
	</div>


</div>
</div>
@endsection