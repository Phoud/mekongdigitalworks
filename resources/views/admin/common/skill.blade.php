@extends('admin.common.main')
@section('title','Skill')
@section('content')

<div class="wrapper">
  <div class="content-wrapper">
  <div class="container">
	<h2>Skill Update</h2>
	<br>
	<div class="col-md-10 md-offset-2">
	<form action="{{route('admin.skill.store')}}" method="post" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<label>Skill Name</label>
	<input type="text" name="skill_name" class="form-control" required="" placeholder="Ex: App development skill,...">
	<label>Color</label>
	<input type="text" name="color" class="form-control" required="" placeholder="color1-color4">
	<label>Percentage</label>
	<input type="text" name="percentage" class="form-control" required="" placeholder="Ex:50%">
	<br>
	<button class="btn btn-primary" type="submit">Save</button>
	<br>
	<br>
	<hr>
	</form>
	</div>
	@foreach($skill as $s)
	<br>
	<br>
	<div class="col-md-10">
		<form action="{{route('admin.skill.update',$s->id)}}" method="post" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<label>Skill Name</label>
	<input type="text" name="skill_name" class="form-control" required="" value="{{$s->skill_name}}">
	<label>Color</label>
	<input type="text" name="color" class="form-control" required="" value="{{$s->color}}">
	<label>Percentage</label>
	<input type="text" name="percentage" class="form-control" required="" value="{{$s->percent}}">
	<br>
	<div class="col-md-1">
	<button class="btn btn-warning" type="submit">Edit</button>
	<br>
	</div>
	</form>
	<div class="col-md-1">
	<form action="{{route('admin.skill.delete',$s->id)}}" method="post">
		<button class="btn btn-danger" type="submit">Delete</button>
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="_method" value="delete">
		<br>
	</form>
	</div>
	</div>
	@endforeach
  </div>
  </div>
</div>
  @endsection