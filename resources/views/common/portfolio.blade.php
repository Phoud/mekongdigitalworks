    @extends('common.main')
    @section('title','ຜົນງານ')
    @section('content')
	
	<div id="breadcrumb">
		<div class="container">	
			<div class="breadcrumb">							
				<li><a href="\">ໜ້າຫຼັກ</a></li>
				<li>ຜົນງານ</li>			
			</div>		
		</div>	
	</div>
	
	<!-- works -->
    <style type="text/css">
    .text{
		color:#ffffff;
	}
    </style>
    <center><h2><b>ຜົນງານຕ່າງໆຂອງພວກເຮົາ</b></h2></center>
<div id="works"  class=" clearfix grid" style="margin:30px"> 
@foreach($portfolio as $show)
    <a href="http://{{$show->address}}" target="_blank">
    <figure class="effect-oscar  wowload fadeIn">
        <img src="{{url('/')}}/images/portfolios/{{$show->image_name}}" alt="img01"/>
        <figcaption>
            <h2 class="text">{{$show->company_name}}</h2>
            <p class="text">{{$show->address}}<br>
            </p> 

        </figcaption>
    </figure></a>
    @endforeach
</div>

@endsection