@extends('admin.common.main')

@section('title','Mekong | New Post')


@section('content')
<div class="wrapper">

  <div class="content-wrapper">

  @include('admin.partial._message')
  <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><i clas="fa fa-dashboard"></i>Dashboard</li>
        <li><i class="glyphicon glyphicon-ice-lolly-tasted"></i> Blog</li>
        <li><i class="active"></i> Add New</li>
      </ol>
  </section>
  <!-- Content -->
  <section class="content">
    @include('admin.partial._modal')
   
  <div class="col-md-12 post-content">
    <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Create a post</h3>
            </div>
            <form role="form" id="blog-form" action="{{ route('blog.store')}}" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
              <div class="box-body">
                <div class="form-group">
                  <label>Select Blog Category</label>
                  <select id="blogtype" class="form-control" name="blog_category">
                  @foreach($cates as $cate)
                    <option value="{{$cate->id}}" {{old('blog_category') == $cate->id ? 'selected' : ''}}>{{$cate->name}}</option>
                  @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="title">Post Title</label>
                  <input type="text" name="title" value="{{ old('title') != null ? old('title') : ''}}" class="form-control" placeholder="Enter title" required>
                </div>

                <div class="form-group">
                  <label for="title">Post Image Title</label>
                  <input type="file" name="img_title" class="form-control" required>
                </div>

                <div class="form-group">
                  <label for="slug">Post Slug (No spacebar)</label>
                  <input type="text" name="slug" class="form-control" value="{{ old('slug') != null ? old('slug') : ''}}" placeholder="Enter slug" required>
                </div>
                <div class="form-group">
                  <label for="slug">Post Description</label>
                  <textarea  name="description" class="form-control" placeholder="Enter Description" rows="4" required>{{ old('description') != null ? old('description') : ''}}</textarea>
                </div>
                <div id="promotion_date" style="display: none;">
                  <div class="col-md-6" style="margin-top: 14px;">
                    <div class="form-group">
                        <label for="image">Promotion start: </label>
                        <div class='input-group date' id='datetimepickerStart'>
                            <input type='text' class="form-control" name="start" id="startdate" value="{{ old('start') != null ? old('start') : ''}}"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-6" style="margin-top: 14px;">
                    <div class="form-group">
                        <label for="image">Promotion Expire: </label>
                        <div class='input-group date' id='datetimepickerStop'>
                            <input type='text' class="form-control" name="expire" value="{{ old('expire') != null ? old('expire') : ''}}" id="expiredate"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                  <label for="editor_tiny">Post Content</label>
                    <textarea id="editor_tiny" class="editor form-control" name="body">{{ old('body') != null ? old('body') : ''}}</textarea>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-success btn-flat btn-block">Publish</button>
              </div>
          </form>
      </div>
    </div>
  </section>
</div>
</div>
<!-- ./wrapper -->
@stop

@section('js')
<script type="text/javascript" src="{{ url('/')}}/tiny/jquery.tinymce.min.js "></script>
<script type="text/javascript" src="{{ url('/') }}/tiny/tinymce.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/tiny/tinymce.setting.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/AjaxImage.js"></script>
<script>
$(document).ready(function(){
  var content = $(".content-wrapper");
  if(content != null){
    content.css('min-height', '600px')
    var f = function(){
      var content = $(".content-wrapper");
      var height = $('.post-content:visible').height();
      content.css('min-height', '600px'); 
      content.css('height', height+150 + 'px');
      removeTitle();
    }
    window.addEventListener("scroll",f, false);
  }
});
</script>
@stop