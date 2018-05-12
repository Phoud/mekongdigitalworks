<!DOCTYPE html>
<html lang="en">
  <head>
	@include('partial.header')
  </head>
  <body>
  	@include('partial.navbar')
  	@yield('content')
  	@include('partial.footer')
  </body>
  </html>