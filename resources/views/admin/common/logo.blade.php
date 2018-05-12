@extends('admin.common.main')
@section('title','Logo')
@section('content')

<div class="wrapper">
  <div class="content-wrapper">
  	<div class="col-md-3 col-md-offset-2">
  	<h4>Upload a logo</h4>
 <form action="{{route('admin.logo.store')}}" method="post" enctype="multipart/form-data">
 	<input type="hidden" name="_token" value="{{csrf_token()}}">
  <input type="file" name="pic" accept="image/*">
  <br>
  <input class="btn btn-success" type="submit">
</form>
	</div>
	<div class="col-md-3">
			<img style="max-height:70px; margin-top:20px;" src="{{url('/')}}/images/logo/{{isset($logoname->filename) ? $logoname->filename : 'logo.png'}}">
			<a href="" class="btn btn-danger">Delete</a>
	</div>
  <form action="{{route('admin.register.store')}}" method="post">
  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <input class="form-control" type="text" name="name">
  <input class="form-control" type="text" name="surname">
  <button type="submit" class="btn btn-success">Submit</button>

</form>
@foreach($registershow as $show)
<div class="col-md-6">

<form action="{{route('admin.edit.store', $show->id)}}" method="post">
<input type="hidden" name="_token" value="{{csrf_token()}}">
<h4 hr>Name</h4>
<input type="text" name="name" value="{{$show->name}}">
  </div>
  <div class="col-md-6">
<h4>Surname</h4>
<input type="text" name="surname" value="{{$show->surname}}">
 <button type="submit">Edit</button>

</form>
<form method="post" action="{{route('admin.delete.store',$show->id)}}">
<button class=" btn-danger" type="submit">Delete</button>
<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="hidden" name="_method" value="delete">
</form>
</div>

 @endforeach
 
</div>
</div>

</div>

@endsection