<header>        
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="navigation">
<div class="container">                 
<div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse.collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
  
        <a href="\"><img src="{{url('/')}}/images/logo/{{isset($logoname->filename) ? $logoname->filename : 'logo.png'}}" style="max-height:80px;"></a>
    
</div>

<div class="navbar-collapse collapse">                          
    <div class="menu">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"><a href="/" class="active">Home</a></li>
            <li role="presentation"><a href="{{route('homepage.services')}}">Our Services</a></li>
           {{--  <li role="presentation"><a href="{{route('homepage.package')}}">ແພັກເກັດ</a></li>   
            <li role="presentation"><a href="{{route('homepage.templates')}}">ແທັມເພັລດ</a></li>  --}}           
            {{-- <li role="presentation"><a href="{{route('homepage.portfolio')}}">Portfolio</a></li> --}}
            <li role="presentation"><a href="{{route('homepage.plainblog')}}">News</a></li>
            <li role="presentation"><a href="{{route('homepage.about')}}">About Us</a></li>
            <li role="presentation"><a href="{{route('homepage.contact')}}">Contact Us</a></li>                     
        </ul>
    </div>
</div>                      
</div>
</div>  
</nav>      
</header>