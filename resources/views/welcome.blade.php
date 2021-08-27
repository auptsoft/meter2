<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'meter') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            html, body {
                background-image: linear-gradient(#fff, #fff);
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                scroll-snap-type: y mandatory;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
                font-weight: bold;
                color: #aa3
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .cover_image {
                background-repeat: no-repeat;
                background-size: cover;
                background-attachment: fixed;
                box-shadow: 0px 5px 5px gray;
            }

            .links > .menu-item {
                background-color: #fff;
                transition: background-color 0.5s, color 0.8s;
                padding: 10px;
                border-radius: 10px;
                margin: 10px;
                box-shadow: 1px 1px 2px gray;
            }

            .links > .login-menu {
                background-image: linear-gradient(#aa3, #fff);
            }
            
            .links > .menu-item:hover {
                background-image: linear-gradient(#fff, #aa3);
                color: #fff;
                transform: translate(0px, 5px);
                box-shadow: 0px 0px 10px #fff;
                
            }

            .sub-item {
                background-color: #fff;
                margin:5px;
                margin-top:20px;
                padding: 5px;
                padding-left: 10px;
                padding-right: 10px;
                border-radius: 5px;
                box-shadow: 2px 2px 5px gray;
                
            }

            .sub-item-row {
                margin-bottom: 50px;
            }

            .profile-container, .author-details {
                float: none;
            }
        </style>

    </head> 
    
    <body> 
        <div class="flex-center position-ref full-height cover_image" style="background-image: url('{{ asset('storage/bright-bulb-close-up-459718.jpg') }}')">
            @if (Route::has('login'))
            @endif

            <div class="content">
                <div class="">
                    <div class="title m-b-md">
                    {{ config('app.name', 'Metering') }}
                    </div>
                    <div class="links">
                        <a class="menu-item" href="{{ url('/meter') }}">My Meter</a>
                        <a class="menu-item login-menu" href="{{ url('/login') }}">Dashboard</a>
                        <!-- <a class="menu-item" href="{{ url('/customer_recharge') }}">Recharge</a> -->
                        
                    </div>
                </div>
            </div>
        </div>      
        <div class="container">
            <div class="row sub-item-row">
                <div class="col-md-8 ">
                    <div class="sub-item" >
                        <h1> About</h1>
                        <p> Metering base station dashboard is a HMI (Human Machine Interface) software used to monitor and control all the meter in a distribution system. 
                            It also manages customer subscription and recharge pins.  </p>
                    </div>
                </div>

                <!-- <div class="col-md-4">
                    <div class="sub-item" >
                        hello
                    </div>
                </div> -->
                
                <div class="col-md-4">
                    <div class="sub-item" >
                        <h1> Author </h1>
                        
                        <div class="profile-container"> 
                            <img src="{{asset('storage/profile.jpg')}}"  />
                        </div>
                        <div class="author-details">
                            Name: <b> EDEMIRUKAYE UKEH ORODJE </b>
                            <br />
                            Mat. No.: <b>PG/ENG/1208916 </b>
                            <h4> Academic Profile and acheivement </h4>
                             <p> B.Eng (Uniben), M.Eng (Uniben) MIET (UK), COREN Regd, MNSE </p>
                             <h4> Profile Summary </h4>
                             <p> Mr. Edemirukaye Ukeh Orodje is a lecturer in the department of computer engineering and teaches 
                                 data communication and networking, Computer Fundamental, Assembly Language Programming, IT Testing 
                                methods and reliability, computer hardware and Maintenace. He is a member of Nigerian Society of 
                                Engineers and Institue of Engineering and Technology (IET), His research areas are mainly
                                in the field of Computer/Electronic/Telecommunications with emphasis on web based systems. Ares of
                                of specialization: Computer/Electronic/Telecommunications with emphasis on Web based System. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </body>
</html> 
