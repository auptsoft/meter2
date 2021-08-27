@php
    use Illuminate\Support\Facades\Route;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel= "stylesheet" >
    @yield('head')
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel" >
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }} 
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>

                            {{--@if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                        <li class="{{Route::currentRouteName()==='home' ? 'nav-item-active':'nav-item'}}">
                                    <a class="nav-link" href="{{ url('/home') }}">{{ __('About') }}</a>
                         </li>  
                            @if(Auth::user()->can('ownMeter', App\Meter::class))
                                <li class="{{Route::currentRouteName()==='my_meter' ? 'nav-item-active':'nav-item'}}">
                                    <a class="nav-link" href="{{ route('my_meter') }}">{{ __('My Meter') }}</a>
                                </li>   
                                <li class="{{Route::currentRouteName()==='customer_recharge' ? 'nav-item-active':'nav-item'}}">
                                    <a class="nav-link" href="{{ url('customer_recharge ') }}">{{ __('Recharge') }}</a>
                                </li>   
                            @endif

                            @if(Auth::user()->can('viewAll', App\Meter::class))
                            <li class="{{Route::currentRouteName()==='all_meters' ? 'nav-item-active':'nav-item'}}">
                                    <a class="nav-link" href="{{ route('all_meters') }}">{{ __('All meters') }}</a>
                            </li> 
                            <li class="{{Route::currentRouteName()==='vouchers' ? 'nav-item-active':'nav-item'}}">
                                    <a class="nav-link" href="{{ route('vouchers')  }}">{{ __('Vouchers') }}</a>
                            </li> 
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    @if(Auth::user()->can('createStaff', App\User::class))
                                        <a class="dropdown-item" href="{{ route('reg_staff') }}">{{ __('Register New Staff') }}</a>
                                     @endif
                                     @if(Auth::user()->can('createCustomer', App\User::class))
                                        <a class="dropdown-item" href="{{ route('reg') }}">{{ __('Register New Customer') }}</a>
                                     @endif
                                     @if(Auth::user()->can('create', App\Meter::class))
                                        <a class="dropdown-item" href="{{ route('meter/create') }}">{{ __('Register New Meter') }}</a>
                                     @endif

                                     @if(Auth::user()->can('viewAll', App\Meter::class))
                                        <a class="dropdown-item" href="{{ route('settings') }}">{{ __('Settings') }}</a>
                                     @endif

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @if (isset($msg)) 
          <div class="{{$class}}"> $msg </div>
        @endif
        <div id="app">
            <main class="">
                :@auth
                    <line-status > </line-status>
                @endauth
                
                @yield('content')
            </main>
            
        </div>
    </div>
</body>
</html>
