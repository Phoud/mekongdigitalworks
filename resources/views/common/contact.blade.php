	@extends('common.main')
	@section('title', 'Contact Us')
	@section('content')
    
	
	<div id="breadcrumb">
		<div class="container">	
			<div class="breadcrumb">							
				<li><a href="\">Homepage</a></li>
				<li>Contact Us</li>			
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
                <h2>Contact Mekong Digital Works</h2>
                <p><b>E-mail: {{$contact->email}}
                <br>Tel: {{$contact->phone_number1}}</br>Mobile: {{$contact->phone_number2}}</b></p>
            </div> 
            <div class="row contact-wrap"> 
                <div class="status alert alert-success" style="display: none"></div>
                <div class="col-md-6 col-md-offset-3">
                    <div id="sendmessage">Your message has been sent. Thank you!</div>
                    <div id="errormessage"></div>
                    <form action="{{route('homepage.contact.store')}}" method="post" role="form" class="contactForm">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                    <div class="validation"></div>
                            </div>
                            <div class="form-group">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Your email" data-rule="email" data-msg="Please enter a valid email" />
                                    <div class="validation"></div>
                            </div>
                            <div class="form-group">
                                    <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Your message"></textarea>
                                    <div class="validation"></div>
                            </div>
                        <div class="text-center"><button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">Send</button></div>
                    </form>                       
                </div>
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#contact-page-->
	
	@endsection