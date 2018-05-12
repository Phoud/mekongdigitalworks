@extends('common.main')
@section('title','Our Services')
@section('content')
	
	<div id="breadcrumb">
		<div class="container">	
			<div class="breadcrumb">							
				<li><a href="\">Homepage</a></li>
				<li>Our Services</li>			
			</div>		
		</div>	
	</div>
	
	<div class="services">
		<div class="container">
			<h3>Our Services</h3>
			<hr>
			<div class="col-md-6">
			@if(isset($service1))
				<img src="{{url('/')}}/images/services/{{$service1->image_name}}" class="img-responsive">
				<p>{{$service1->discription}}</p>
			@endif
			</div>
			
			<div class="col-md-6">
				<div class="media">
					<ul>
					@foreach($servicepage as $s)
						<li>
							<div class="media-left">
								<i class="fa fa-{{$s->logo_name}}"></i>						
							</div>
							<div class="media-body">
								<h4 class="media-heading">{{$s->service_name}}</h4>
								<p>{{$s->service_discription}}</p>
							</div>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>	
	
	<div class="sub-services">
		<div class="container">
			<div class="col-md-6">
				<div class="media">
					<ul>
					@foreach($servicesecond as $ss)
						<li>
							<div class="media-left">
								<i class="fa fa-{{$ss->logo_name}}"></i>						
							</div>
							<div class="media-body">
								<h4 class="media-heading">{{$ss->service_name}}</h4>
								<p>{{$ss->service_discription}}</p>
							</div>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
						
			<div class="col-md-6">
				@if(isset($service2))
				<img src="{{url('/')}}/images/services/{{$service2->image_name}}" class="img-responsive">
				<p>{{$service2->discription}}</p>
				@endif
			</div>
		</div>
	</div>
    
   @endsection