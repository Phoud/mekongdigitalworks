@extends('common.main')
	@section('title','About Us')
	@section('content')
	<div id="breadcrumb">
		<div class="container">	
			<div class="breadcrumb">							
				<li><a href="\">Home</a></li>
				<li>About Us</li>			
			</div>		
		</div>	
	</div>
	
	<div class="aboutus">
		<div class="container">
			<h3>Company Profile</h3>
			<hr>
			<div class="col-md-7 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
				<img src="{{url('/')}}/images/About/{{$info->profile}}" class="img-responsive">
				<h4>{{$info->slogan}}</h4>
				<p>{{$info->slogan}}</p>
			</div>
			<div class="col-md-5 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
				<div class="skill">
					<h2>Our Skills</h2>
					
				@foreach($skill as $s)
					<div class="progress-wrap">
						<h4>{{$s->skill_name}}</h4>
						<div class="progress">
						  <div class="progress-bar {{$s->color}}" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: {{$s->percent}}%">
						   <span class="bar-width">{{$s->percent}}%</span>
						  </div>
						</div>
					</div>
				@endforeach
			
				</div>				
			</div>
		</div>
	</div>
	
	<div class="our-team">
		<div class="container">
			<h3>Our Team</h3>	
			<div class="text-center">
			@foreach($team as $t)
				<div class="col-md-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
					<img src="{{url('/')}}/images/About/{{$t->profile_name}}" alt="" style="max-height: 200px;">
					<h4>{{$t->name}}</h4>
					
					<h5>{{$t->position}}</h5>
					<ul>
                       <li class="fa fa-envelope" style="color:#000000"> {{$t->email}}</li><br>
                       <li class="fa fa-tty" style="color:#000000"> {{$t->phone}}</li>
                       <li><a href="http://{{$t->facebook}}" target="_blank"><img style="max-height: 100px; margin-right: 30px;" src="images/About/facebook.png"></a></li>
                    </ul>
				</div>
			@endforeach
			</div>
		</div>
	</div>
	
@endsection