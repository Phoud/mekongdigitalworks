@extends('common.main')
@section('title','Mekong Digital Works')

@section('content')
	<!-- Start-Slider -->
<section >
     <div id="myCarousel" class="carousel slide" data-ride="carousel"> 
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>


<div class="carousel-inner">
  <?php $sl= 0; $ch_sl = false; ?>
   @foreach($banner_name as $show)
    <div class="item {{ $sl == 0 ? 'active' : ''}}"> 
    
      <img src="{{url('/')}}/images/banners/{{ $show->banner_name}}" style="width:100%;" alt="{{ $show->banner_name}}"></a>
      <div class="container">
        <div class="carousel-caption">
        </div>
      </div>
    </div>
    <?php $sl = 1; $ch_sl = true;?>
  @endforeach
  @if($ch_sl == false)
     <div class="item active">
     </div>
  @endif
  </div>



  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
  	<span class="glyphicon glyphicon-chevron-left"></span></a> 
     <a class="right carousel-control" href="#myCarousel" data-slide="next">
     <span class="glyphicon glyphicon-chevron-right"></span>
  </a> 
</div><!--/.carousel-->
 </section>

 <!--/#End-slider-->
	<!--Service-->
	<div class="feature">
		<div class="container">
			<div class="text-center">

			@foreach($service_show as $show)
				<div class="col-md-3">
					<div class="hi-icon-wrap hi-icon-effect wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="100ms" >
						<i class="fa fa-{{$show->logo_name}}"></i>	
						<h2>{{$show->service_name}}</h2>
						<p>{{$show->service_discription}}</p>
					</div>
				</div>
				@endforeach 
			</div>
		</div>
	</div>

	<!--End-Service-->
	
	<div class="about">
	@foreach($aboutus_display as $display)
		<div class="container">
			<div class="col-md-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="100ms" >
				<img src="{{url('/')}}/images/{{$display->profile_image_name}}" class="img-responsive"/>

			</div>
			
			<div class="col-md-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="200ms" >
				<h2>{{$display->company_name}}</h2>
				<h4 style="line-height: 2.0em;">{{$display->company_info}}</h4>
				
			</div>
		</div>
		@endforeach
	</div>
	
	<div class="lates">
		<div class="container">
			<div class="text-center">
        @if(count($blogs_gallery)>0)
				<h2>Latest News</h2>
        @endif
			</div>
    @foreach($blogs_gallery as $blog)
			<a href="{{route('blog.single',$blog->slug)}}"><div class="col-md-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
				<img src="{{url('')}}/img/upload/{{$blog->img_title}}" class="img-responsive"/>
				<h3>{{$blog->title}}</h3>
				<p>{{mb_substr($blog->description,0,280,'UTF-8')}}</p>
			</div></a>
	@endforeach
		</div>
	</div>
	
	<section id="partner">
        <div class="container">
            <div class="center wow fadeInDown">
                <h2>Our Customers</h2>
                <p></p>
            </div>    
		
            <div class="partners">
                <ul>
                @foreach($partner_display as $show)
                    <li style="padding-right: 2em;"> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" src="{{url('/')}}/images/partners/{{$show->image_name}}"></a></li>
                   @endforeach
                </ul>
            </div>        
        </div><!--/.container-->
    </section><!--/#partner-->

    <style type="text/css">
    	#partner {
			  background: url(../images/partners/{{$background_display->image_name}}) 50% 50% no-repeat;
			  background-size: cover;
				}
    </style>
	
	<section id="conatcat-info">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="media contact-info wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="pull-left">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="media-body">
                            <h4>Contact Us</h4>
                            <p><b>E-mail: {{$contactshow->email}}<br/>Mobile: {{$contactshow->phone_number1}}<br>Mobile: {{$contactshow->phone_number2}}</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.container-->    
    </section><!--/#conatcat-info-->
    @endsection