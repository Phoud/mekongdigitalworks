@extends('admin.common.mainlogin')
  <!-- Font Awesome -->


@section('title', 'MDW | Login')

@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="{{url('/')}}/admin/dashboard"><b>Mekong</b>.Digital</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

   
    <form action="{{route('post.login')}}" method="POST">
    {{ csrf_field() }}
    <div class="form-group has-feedback">
    
    <input type="email" name="email" class="form-control" required placeholder="Email" maxlength="191">
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
    <input type="password" name="password" class="form-control" required placeholder="Password" maxlength="191">
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>  
    <div class="row">
        {{-- <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div> --}}
        <!-- /.col -->
        <div class="col-xs-12">
           <input type="submit" class="btn btn-primary btn-block btn-flat pull-right">
        </div>
        <!-- /.col -->
      </div>
    </form>
  
    {{-- <a href="#">I forgot my password</a><br> --}}

  </div>
  <!-- /.login-box-body -->
</div>
@stop
