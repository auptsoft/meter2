@extends('layouts.app')

@section('head')
<style>
    .dashboard-container {
        display: flex;
        justify-items: stretch;
    }
    .dashboard-item {
         
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Quick Links</div>

                <div class="card-body dashboard-container">
                    @if(Auth::user()->can('ownMeter', App\Meter::class))
                        <div class="card">
                            <a class="nav-link" href="{{ route('my_meter') }}">{{ __('My Meter') }}</a>
                        </div>
                        <div class="card">
                            <a class="nav-link" href="{{ url('customer_recharge ') }}">{{ __('Recharge') }}</a>
                        </div>
                    @endif
                    @if(Auth::user()->can('viewAll', App\Meter::class))
                        <div class="card dashboard-item">
                            <a class="nav-link" href="{{ route('all_meters') }}">{{ __('All meters') }}</a>
                        </div>
                        <div class="card">
                            <a class="nav-link" href="{{ route('vouchers')  }}">{{ __('Vouchers') }}</a>
                        </div>
                        @if(Auth::user()->can('createStaff', App\User::class))
                        <div class="card">
                            <a class="nav-link" href="{{ route('reg_staff') }}">{{ __('Register New Staff') }}</a>
                        </div>
                        @endif
                        @if(Auth::user()->can('createCustomer', App\User::class))
                        <div class="card">
                            <a class="nav-link" href="{{ route('reg') }}">{{ __('Register New Customer') }}</a>
                        </div>
                        @endif
                        @if(Auth::user()->can('create', App\Meter::class))
                        <div class="card">
                            <a class="nav-link" href="{{ route('meter/create') }}">{{ __('Register New Meter') }}</a>
                        </div>                    
                        @endif

                        @if(Auth::user()->can('viewAll', App\Meter::class))
                        <!-- <div class="card">
                            <a class="nav-link" href="{{ route('settings') }}">{{ __('Settings') }}</a>
                        </div> -->
                        @endif
                    @endif
                </div>
            </div>
            
            
            <div class="card" style="margin-top: 2em">
                <div class="card-header"> About Author </div>
                <div class="card-body">
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
        <div class="col-md-4">
        <div class="card" >
            <div class="card-header">
                Brief
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="sub-item" >
                        <p> Metering base station dashboard is a HMI (Human Machine Interface) software used to monitor and control all the meter in a distribution system. 
                            It also manages customer subscription and recharge pins.  </p>
                         </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
       
    </div>
</div>
@endsection
