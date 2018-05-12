    @extends('common.main')
    @section('title', 'News')
    @section('content');
	
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
                @foreach($blogs as $blog)
                    <div class="blog-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-2">
                                <div class="entry-meta">
                                    <span id="publish_date">{{date('d F Y', strtotime($blog->updated_at))}}</span>
                                </div>
                            </div> 
                            <div class="col-xs-12 col-sm-10 blog-content">
                                <a href="{{route('blog.single', $blog->slug)}}"><img class="img-responsive img-blog" src="{{url('')}}/img/upload/{{$blog->img_title}}" width="100%" alt="" /></a>
                                <h3>{{$blog->title}}</h3>
                                <p>{{mb_substr($blog->description,0,250,'UTF-8')}}...</p>
                                <a href="{{route('blog.single', $blog->slug)}}" class="btn btn-primary readmore">ອ່ານເພີ່ມເຕີມ <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>    
                    </div><!--/.blog-item-->
                    @endforeach
                        
                    <ul class="pagination pagination-lg">
                        {!! $blogs->links() !!}
                    </ul><!--/.pagination-->
                </div><!--/.col-md-8-->
                <aside class="col-md-4">
                    <div class="widget search">
                        <form role="form">
                            <input type="text" class="form-control search_box" autocomplete="off" placeholder="ຄົ້ນຫາ">
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