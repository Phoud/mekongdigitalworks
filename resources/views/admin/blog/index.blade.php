@extends('admin.common.main')

@section('title','Mekong | Blogs')

@section('content')
<div class="wrapper">

  <div class="content-wrapper" style="min-height: 1000px;">

  @include('admin.partial._message')
  <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><i clas="fa fa-dashboard"></i>Dashboard</li>
        <li><a href="#"><i class="glyphicon glyphicon-ice-lolly-tasted"></i> Blogs</a></li>
      </ol>
  </section>
  <!-- Content -->
  <section class="content">
  <div class="col-md-12 post-content">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Blogs Timeline - {{App\Blog::all()->count()}} Total.</h3>
    
              <div class="box-tools">
                <button class="btn btn-primary" type="submit" form="form-post"><i class="fa fa-save"></i></button>
                <a href="{{ url('/admin/') }}" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding" style="overflow: auto; overflow-y: hidden; -ms-overflow-y: hidden;">
            <form action="{{route('post.settings')}}" id="form-post" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width:auto;">#</th>
                  <th>Post Title</th>
                  <th>Post Type</th>
                  <th>Post Status</th>
                  <th class="text-center">Start At</th>
                  <th class="text-center">Expire At</th>
                  <th class="text-center">Sort Order</th>
                  <th>View</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              <?php $i = 1; ?>
              @foreach($posts as $post)
                <tr>
                  <td>{{$i}}.{{-- -{{$post->id}} --}}</td>
                  <td>{{ mb_substr($post->title, 0, 60 ,'UTF-8') }} {{ mb_strlen($post->title, 'UTF-8') > 60 ? '...' : '' }}</td>
                  <td>{{$post->type}}</td>
                  <td>
                      <select name="post_status[{{$post->id}}][]" class="form-control">
                        <option value="1" {{$post->status == 'published' ? 'selected': ''}}>Published</option>
                        <option value="0" {{$post->status == 'unpublished' ? 'selected': ''}}>Unpublished</option>
                    </select>
                  </td>
                  <td class="text-center">{{$post->start}}</td>
                  <td class="text-center">{{$post->expire}}</td>
                  <td class="text-center"><input class="form-control" type="text" name="sort[{{$post->id}}][]" value="{{$post->sort_order}}"></td>
                  <td class="text-center"><a class="btn btn-primary btn-flat" href="{{route('blog.single', $post->slug)}}" target="_blank"><i class="fa fa-eye"></i></a></td>
                  <td class="text-center"><a class="btn btn-primary btn-flat" href="{{route('blog.edit', $post->id)}}"><i class="fa fa-pencil"></i></a></td>
                  <td>
                    <select name="post_delete[{{$post->id}}][]" class="form-control">
                        <option value="-1">None</option>
                        <option value="0" >Delete</option>
                    </select>
                  </td>
                </tr>
              <?php $i++; ?>
              @endforeach
             </form>
              </tbody>
            </table>
            </div>
            <!-- /.box-body -->
            <div class="text-center">
              {{ $posts->links() }}
            </div>
          </div>
        </div>
  </section>


</div>
</div>
<!-- ./wrapper -->
@stop

@section('js')
<script>
  $(document).ready(function(){
  var content = $(".content-wrapper");
  if(content != null){
    content.css('min-height', '600px')
    var f = function(){
      var content = $(".content-wrapper");
      var height = $('.post-content:visible').height();
      content.css('min-height', '600px'); 
      content.css('height', height+350 + 'px');
    }
    window.addEventListener("scroll",f, false);
  }
});
</script>
@stop
