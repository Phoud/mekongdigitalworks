	@extends('common.main')
	@section('title', 'Template')
	@section('content')
    
	
	<div id="breadcrumb">
		<div class="container">	
			<div class="breadcrumb">							
				<li><a href="\">ໜ້າຫຼັກ</a></li>
				<li>ແທັມເພລັດ</li>			
			</div>		
		</div>	
	</div>
	<br>
	<div id="works"  class=" clearfix grid">
	@foreach($tem as $t)
        <figure class="effect-oscar  wowload fadeIn" style="padding:20px">
           <a href="http://{{$t->template}}" target="_blank">
           <img src="{{url('/')}}/images/templateview/{{$t->images}}" alt="img"/></a>
        </figure> 
   @endforeach
    </div>
@endsection