@extends('layouts.app')
@section('head')
   <style> 

        .body {
            
        }

        main {
            background-image: url('{{asset('storage/bright-bulb-burnt.jpg')}}');
            background-size: cover;
            padding-top: 0px;
        }

        .navbar {
            display: none;
        }

        .container-row {
            width: 20rem;
            
        }

        .full-height {
            height: 100vh;
            
        }

        .flex-cen{
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .login-container {
            background-color: rgba(50, 50, 50, 0.7);
            padding: 20px;
            border-radius: 20px;
        }

        .login-header > h1 {
            text-align: center;
            color: white;
        }

        .login-body {

        }

        .form-control {
            transition: background-image 2s;
            border-radius: 20px;
            text-align: center;
            border-style: none;
        }

        .form-control:hover {
            background-image: linear-gradient(#fff, #ddd);
            
        }

        .form-control:focus {
            background-image: linear-gradient(#fff, #aaa);
        }

        .btn {
            //background-image: linear-gradient(#aa3, #fff);
            color: black;
                transition: background-color 0.5s, color 0.8s;
                padding: 5px 10px;
                border-radius: 10px;
                margin: 10px;
                box-shadow: 1px 1px 2px gray;
                
                border-style: none;
                
        }

        .btn:hover {
                background-image: linear-gradient(#fff, #aa3);
                color: #fff;
                box-shadow: 0px 0px 10px #fff;
                
            }
   </style>
@endsection
@section('content')
<div class="full-height flex-cen">
    <div class="container-row justify-content-center">
        <div class="col-md-">
            <div class="login-container">
                <div class="login-header"><h1>{{ __('Login') }}</h1></div>

                <div class="login-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group ">
                            <!-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> -->

                            <div class="">
                                <input placeholder="Email" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group ">
                            <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> -->

                            <div class="">
                                <input placeholder="Password" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-grou">
                            <div class="">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    {{ __('Login') }}
                                </button>

                                <!-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
