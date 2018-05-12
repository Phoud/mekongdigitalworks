@extends('admin.common.main')
@section('title','Banner')
@section('content')
@include('partial.alert')

<div class="wrapper">
  <div class="content-wrapper">
    <h3>Banners</h3>
    <br>
    <br>
  <div class="col-md-3">
    <h4>Banner</h4>
    <form action="{{route('admin.banner.store')}}" method="post" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <input type="file" name="banner1" accept="image/*">
      <br>
      <button type="submit" class="btn btn-success btn-sm">Submit</button>
    </form>
  </div>
  @foreach($banner_name as $show)
  <div class="col-md-3">
  <img style="max-height:70px; margin-top:20px;" src="{{url('/')}}/images/banners/{{$show->banner_name}}">
  <br>
  <br>
<form method="post" action="{{route('admin.banner_delete.store',$show->id)}}">
<button class=" btn-danger" type="submit">Delete</button>
<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="hidden" name="_method" value="delete">
</form>
  </div>
 @endforeach
</div>
</div>
@endsection