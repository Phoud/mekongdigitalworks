	@extends('common.main')
	@section('title', 'Package')
	@section('content')
	
	<div id="breadcrumb">
		<div class="container">	
			<div class="breadcrumb">							
				<li><a href="/">ໜ້າຫຼັກ</a></li>
				<li>ແພັກເກັດ</li>			
			</div>		
		</div>	
	</div>
	<hr/><!--/#pricing-->
    @foreach($cats as $cat)
    <section class="section-padding">
		<div class="container">
			<div class="row">
				<!-- Heading -->
				<div class="col-md-12 text-center">
					<h1 class="section-title red-heading">{{$cat->name}}</h1>
					<p></p>
				</div>
				<!-- Pricing Table Area -->
				<div class="gg-pricing-table icon-table col-md-12 mt-50">
					<!-- Single Table -->
					@foreach($shows as $show)
					@if($show->cat_id == $cat->id)
					<div class="col-md-4">
						<div class="single-pricing-table text-center clearfix">
							<!-- Heading -->
							<div class="pricing-table-heading">
								{{-- <div class="pricing-icon">
									<img src="assets/images/bicycle.png" alt="" class="center-block img-responsive">
								</div> --}}
								<h2 class="section-title red-heading text-price">{{$show->type}}</h2>
							</div>
							<!-- Price -->
							<div class="price">
								<span>{{$show->price}} Kip</span>
							</div>
								<?php
								 $max = 0; 
								 $a = isset($counts[$show->cat_id][0]) ? $counts[$show->cat_id][0] : 0;
								 $b = isset($counts[$show->cat_id][1]) ? $counts[$show->cat_id][1] : 0;
								 $c = isset($counts[$show->cat_id][2]) ? $counts[$show->cat_id][2] : 0;
								 if($a > $b &&  $a > $c){
								 	$max = $a;
								 }else if($b > $a &&  $b > $c){
								 	$max = $b;
								 }else if($c > $a &&  $c > $b){
								 	$max = $c;
								 }else{
								 	$max = $a;
								 }

								?>
							<!-- Price Item -->
							<?php $package_details = array_filter(explode('^', $show->package_name));?>
							<div class="pricing-item">
								<ul>
									@for($i = 0; $i < $max ; $i++)
										<li><p><strong>{{ isset($package_details[$i]) ? $package_details[$i] : '---'}}</strong></p></li>
									@endfor
						
								</ul>
							</div>
							<!-- Button -->
							<div class="pricing-button">
							<a href="{{route('homepage.signup',$show->id)}}" class="btn btn-pricing">ສັ່ງຈອງ</a>
							</div>
						</div>
					</div>
					@endif
					@endforeach
				</div>
				<!-- Credits -->
				<div class="design-credit text-center col-md-12 mt-40">
					
				</div>
			</div>
		</div>
	</section>
	@endforeach
   
   
					<!-- Credits -->
					
				</div>
			</div>
		</div>
	</section>
    
	@endsection