<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from thememinister.com/health/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Sep 2023 22:49:33 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login</title>

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
    

    <!-- Bootstrap -->
    <link href="{{ asset('backend/assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap rtl -->
    <!--<link href="assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
    <!-- Pe-icon-7-stroke -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('backend/assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}" rel="stylesheet" type="text/css"/>
    <!-- style css -->
    <link href="{{ asset('backend/assets/plugins/toastr/toastr.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/assets/dist/css/stylehealth.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Theme style rtl -->
    <!--<link href="assets/dist/css/stylehealth-rtl.css" rel="stylesheet" type="text/css"/>-->
</head>
<body>

    <div id="preloader">
        <div id="loader"></div>
      </div>
    <!-- Content Wrapper -->
    <div class="login-wrapper">
        <div class="container-center">
            <div class="panel panel-bd">
                <div class="panel-heading">
                    <div id="error_message_content">
                        @if(count($errors) > 0)
                        @foreach( $errors->all() as $message )
                                <div class="alert alert-danger display-hide" id="error_message_content">
                                <span>{{ $message }}</span>
                                </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="view-header">
                        <div class="header-icon">
                            <i class="pe-7s-unlock" style="color: #3f9ef2"></i>
                        </div>
                        <div class="header-title">
                            <h3>Login</h3>
                            <small><strong>Please enter your credentials to login.</strong></small>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form id="loginForm" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                          <label for="username">Email:</label>
                          <input type="email" class="form-control" placeholder="example@gmail.com" :value="old('email')" id="email" name="email">
                        </div>
                        <div class="form-group">
                          <label for="password">Password:</label>
                          <div class="password_input_content">
                            <input type="password" class="form-control" placeholder="********" id="password" name="password" >
                            <div class="eye_content">
                              <span class="input-group-text">
                                <i class="fa fa-eye" id="togglePassword"></i>
                              </span>
                            </div>
                          </div>
                        </div>
                        <button type="submit" class="btn" style="background:#3f9ef2;color:#fff">Login</button>
                      </form>


                </div>
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('backend/assets/plugins/jQuery/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('backend/assets/plugins/toastr/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>

    <script>

        $(document).ready(function () {
          $("#togglePassword").click(function () {
            const passwordField = $("#password");
            const fieldType = passwordField.attr("type");
      
            if (fieldType === "password") {
              passwordField.attr("type", "text");
              $("#togglePassword").removeClass("fa-eye").addClass("fa-eye-slash");
            } else {
              passwordField.attr("type", "password");
              $("#togglePassword").removeClass("fa-eye-slash").addClass("fa-eye");
            }
          });
        });
      </script>
              <script>
                @if (Session::has('message'))
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.success("{{ session('message') }}");
                @endif
    
                @if (Session::has('error'))
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.error("{{ session('error') }}");
                @endif
    
                @if (Session::has('info'))
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.info("{{ session('info') }}");
                @endif
    
                @if (Session::has('warning'))
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.warning("{{ session('warning') }}");
                @endif
            </script>
      <script>
            $(window).on("load", function() {
           $("#preloader").fadeOut(500);
        });
      </script>
      <script>
         $(document).ready(function(){
            $("#error_message_content").delay(4000).slideUp(300);
        });
      </script>
</body>

<!-- Mirrored from thememinister.com/health/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Sep 2023 22:49:33 GMT -->
</html>





{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
