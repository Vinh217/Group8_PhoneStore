<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('public/backend/Admin/Login/images/icons/favicon.ico') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend/Admin/Login/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend/Admin/Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend/Admin/Login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend/Admin/Login/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend/Admin/Login/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend/Admin/Login/vendor/animsition/css/animsition.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend/Admin/Login/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend/Admin/Login/vendor/daterangepicker/daterangepicker.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend/Admin/Login/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend/Admin/Login/css/main.css') }}">
    <!--===============================================================================================-->
</head>
<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
                {{-- <form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{ route('login') }}"> --}}
                <form class="login100-form validate-form flex-sb flex-w" method="POST" action="#">
                    @csrf
                    {{-- {{ csrf_field() }} --}}
                    {{-- @if(isset($loginMessage))
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ $loginMessage }}
            </div>
            @endif --}}
            @if($errors->any())
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{$errors->first()}}
            </div>
            @endif
            <span class="login100-form-title p-b-32">
                Admin Login
            </span>

            <span class="txt1 p-b-11">
                {{ __('E-Mail Address') }}
            </span>
            <div class="wrap-input100 validate-input m-b-36" data-validate="Email is required">
                <input class="input100  @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" autocomplete="email">
                <span class="focus-input100">

                </span>

                {{-- <input class="input100" type="text" name="email">
                @error('email')
                <span class="focus-input100">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror --}}

                {{-- <input id="email" type="text" class="input100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="focus-input100">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror --}}
            </div>

            <span class="txt1 p-b-11">
                {{ __('Password') }}
            </span>
            <div class="wrap-input100 validate-input m-b-12" data-validate="Password is required">
                <span class="btn-show-pass">
                    <i class="fa fa-eye"></i>
                </span>
                <input class="input100" type="password" name="password">
                <span class="focus-input100"></span>
            </div>

            <div class="flex-sb-m w-full p-b-48">
                <div class="contact100-form-checkbox">
                    <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : ''}}>
                    <label class="label-checkbox100" for="ckb1">
                        Remember me
                    </label>
                </div>

                <div>
                    <a href="#" class="txt3">
                        Forgot Password?
                    </a>
                </div>
            </div>

            <div class="container-login100-form-btn">
                <input type="submit" value="Login" class="login100-form-btn">
            </div>

            </form>
        </div>
    </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="{{asset('public/backend/Admin/Login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('public/backend/Admin/Login/vendor/animsition/js/animsition.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('public/backend/Admin/Login/vendor/bootstrap/js/popper.js')}}"></script>
    <script src="{{asset('public/backend/Admin/Login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('public/backend/Admin/Login/vendor/select2/select2.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('public/backend/Admin/Login/vendor/daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('public/backend/Admin/Login/vendor/daterangepicker/daterangepicker.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('public/backend/Admin/Login/vendor/countdowntime/countdowntime.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('public/backend/Admin/Login/js/main.js')}}"></script>

</body>
</html>