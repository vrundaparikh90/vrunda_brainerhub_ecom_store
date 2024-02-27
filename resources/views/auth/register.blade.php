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

        <div id="register1" class="animate form registration_form1">
          <section class="login_content">
           <form id="register_form" name="register_form" method="post" action="{{ route('register') }}">
              @csrf
              <h1>Create Account</h1>
              <div>
                <input id="name" name="name" type="text" class="form-control" placeholder="Name" value="{{ old('name') }}" required/>
                @if ($errors->has('name'))
                    <div class="error customerror">{{ $errors->first('name') }}</div>
                @endif
              </div>
              <div>
                <input id="email" name="email" type="email" class="form-control" placeholder="Email-Id" value="{{ old('email') }}" required/>
                @if ($errors->has('email'))
                    <div class="error customerror">{{ $errors->first('email') }}</div>
                @endif
              </div>
              <div>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" value="{{ old('password') }}" required/>
                @if ($errors->has('password'))
                    <div class="error customerror">{{ $errors->first('password') }}</div>
                @endif
              </div>
              <div>
                <button id="submit" name="submit" class="btn btn-default submit" type="submit">Submit</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="{{ route('login') }}" class="to_register"> Log in </a>
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
</html>