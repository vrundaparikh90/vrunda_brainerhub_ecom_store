<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Vrunda Brainerhub Ecom Store</title>
    <!-- Bootstrap -->
    <link href="{{asset('css/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('css/nprogress.css')}}" rel="stylesheet">
        <!-- Animate.css -->
    <link href="{{asset('css/animate.min.css')}}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{asset('css/custom.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

  </head>

  <body class="login">
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            @if (Session::has('flash_message_success'))
                <div class="alert alert-success alert-block customClass">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{!!session('flash_message_success')!!}</strong>
                </div>
            @endif   
            <form id="login_form" name="login_form" method="post" action="{{ route('login') }}">
              @csrf
              <h1>Login</h1>
                @if (Session::has('flash_message_error'))
                    <div class="alert alert-danger alert-block customClass">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{!!session('flash_message_error')!!}</strong>
                    </div>
                @endif     
              <div>
                <input type="email" id="email" name="email" class="form-control" placeholder="Email-Id"  value="{{ old('email') }}" required/>
                @if ($errors->has('email'))
                    <div class="error customerror">{{ $errors->first('email') }}</div>
                @endif
              </div>
              <div>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password"  value="{{ old('password') }}" required/>
                @if ($errors->has('password'))
                    <div class="error customerror">{{ $errors->first('password') }}</div>
                @endif
              </div>
              <div>
                <button id="submit" name="submit" class="btn btn-default submit" type="submit">Log in</button>
                <!-- <a class="reset_pass" href="#">Lost your password?</a> -->
              </div>

              <div class="clearfix"></div>
    
              <div class="separator">
                <p class="change_link">New to site?
                  <a href="{{ route('register') }}" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i>Vrunda Brainerhub Ecom Store</h1>
                
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
<!-- jQuery -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
</html>