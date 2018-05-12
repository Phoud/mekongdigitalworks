@extends('common.main')
@section('title')
{{$read->title}}@stop
@section('meta')
<meta property="og:type" content="website"/>
  <meta property="og:title" content="{{ $read->title }}"/>
  <meta property="og:description" content="{{ $read->description }}"/>
  <meta property="og:image" content="{{url('')}}/img/upload/{{$read->img_title}}"/>
@stop
@section('content')

<div id="breadcrumb">
<div class="container">	
<div class="breadcrumb">							
<li><a href="\">ໜ້າຫຼັກ</a></li>
<li>ບົດຄວາມ</li>			
</div>		
</div>	
</div>

<section id="blog" class="container">
<div class="blog">
<div class="row">
<div class="col-md-8">
<div class="blog-item">
<div class="row">
<div class="col-xs-12 col-sm-2">
<div class="entry-meta">
  <span id="publish_date">{{date('d F Y', strtotime($read->updated_at))}}</span>
</div>
</div>
                <div class="col-xs-12 col-sm-10 blog-content">
                  <a href="#"><img class="img-responsive img-blog" src="{{url('')}}/img/upload/{{$read->img_title}}" width="100%" alt="" /></a>
                  <h3>{{$read->title}}</h3>
                  <p>{!! $read->body !!}</p>

                </div>
              </div>    
            </div>
            <!--/.blog-item-->
            <!--Social share-->
            <hr/>
            <h4><b>Share</b></h4>
            <ul class="social-network">
             <li><a class="facebook-share-button fb tool-tip" title="Facebook"
                   href="https://www.facebook.com/sharer/sharer.php?u={{route('blog.single', $read->slug)}}"
                   onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-facebook"></i></a></li>

            {{--  <li><a href="#" class="gplus tool-tip" title="Google Plus"><i class="fa fa-google-plus"></i></a></li> --}}
           </ul>
           <hr/>
           <!--Social share-->
           <!--Main_comment-->
           <style type="text/css">
            .p1{
             font-size:16px;
           }
         </style>

         <hr/>

         <!--End-Comment-->
         <!--Comment-Facebook-->
         <h4>Facebook Comment </h4>
         <hr/>
         <div class="fb-comments" data-href="{{route('blog.single', $read->slug)}}" data-numposts="5"></div>
         <!--Comment-Facebook-->
       </div><!--/.col-md-8-->

       <aside class="col-md-4">
        <div class="widget search">
          <form role="form">
            <input type="text" class="form-control search_box" autocomplete="off" placeholder="Search Here">
          </form>
        </div><!--/.search-->

        <div class="widget blog_gallery">
          <h3>Our Gallery</h3>
          <ul class="sidebar-gallery">
            @foreach($blogs_gallery as $gallery)
                <li><a href="{{route('blog.single', $gallery->slug)}}"><img class="img-responsive" style="max-height: 320px;" src="{{url('')}}/img/upload/{{$gallery->img_title}}" alt="" /></a></li>
            @endforeach
          </ul>
        </div><!--/.blog_gallery-->
      </aside>  
    </div><!--/.row-->
  </div>
</section><!--/#blog-->

@endsection