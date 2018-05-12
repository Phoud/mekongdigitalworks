    @extends('common.main')
    @section('title','Template')
    @section('content')
	
	<div id="breadcrumb">
		<div class="container">	
			<div class="breadcrumb">							
				<li><a href="\">ໜ້າຫຼັກ</a></li>
				<li>ແທັມເພລັດເວັບໄຊ້</li>			
			</div>		
		</div>	
	</div>
	
	<!-- works -->
    <center><h2><b>ແທັມເພລັດເວັບໄຊ້</b></h2></center>

<!-- works --><!--/#portfolio-item-->
	<div id="works"  class=" clearfix grid">
    @foreach($packagecate as $p)
        <figure class="effect-oscar  wowload fadeIn" style="padding:20px">
           <a href="{{route('homepage.templateview.edit',$p->id)}}"><img src="{{url('/')}}/images/templatepackage/{{$p->image}}" alt="img01"/></a>
        </figure> 
     @endforeach
    
    </div>
    @endsection