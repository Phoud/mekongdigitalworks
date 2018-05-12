	@extends('common.main')
	@section('title', 'ສັ່ງຈອງແພັກເກັດ')
	@section('content')
    
	
	<div id="breadcrumb">
		<div class="container">	
			<div class="breadcrumb">							
				<li><a href="\">ໜ້າຫຼັກ</a></li>
				<li><a href="{{route('homepage.package')}}">ແພັກເກັດ</a></li>
                <li>ສັ່ງຈອງແພັກເກັດ</li>	
			</div>		
		</div>	
	</div>
	@include('partial._message');
	<div class="map">
		<div></div>
	</div>
	
	<section id="contact-page">
        <div class="container">
            <div class="center">        
                <h2>ລົງທະບຽນເພື່ອສັ່ງຈອງເວັບ</h2>
                <p><b>ກະລຸນາຕື່ມຂໍ້ມູນຂອງທ່ານໃຫ້ຄົບ ແລະ ຖືກຕ້ອງເພື່ອສັ່ງຈອງເວັບ</br></b></p>
            </div> 
            <div class="row contact-wrap"> 
                <div class="status alert alert-success" style="display: none"></div>
                <div class="col-md-6 col-md-offset-3">
                    <div id="errormessage"></div>
                    <form action="{{route('homepage.signup.post')}}" method="post" role="form" class="contactForm">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="pack_id" value="{{$exist}}">
                            <div class="form-group">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="ຊື່ຂອງທ່ານ" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                    <div class="validation"></div>
                            </div>
                             <div class="form-group">
                                    <input type="text" name="phone" class="form-control" id="name" placeholder="ເບີໂທຂອງທ່ານ" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                    <div class="validation"></div>
                            </div>
                            <div class="form-group">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email ຂອງທ່ານ" data-rule="email" data-msg="Please enter a valid email" />
                                    <div class="validation"></div>
                            </div>
                            <div class="form-group">
                                    <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="ຂໍ້ຄວາມ"></textarea>
                                    <div class="validation"></div>
                            </div>
                        <div class="text-center"><button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">ສົ່ງຂໍ້ມູນ</button></div>
                    </form>                       
                </div>
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#contact-page-->
	
	@endsection