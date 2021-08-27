@php
use App\Http\Controllers\PowerConsumedController;
@endphp

@extends('layouts.app')

@section('head')
    <meta name="meter_id" content="{{ $meter->id }}">
    <!-- <script src="{{ asset('js/Chart.bundle.js') }}"> </script> -->
    <style>
        .meter-detail {
            margin-bottom: 40px;
        }

    .item-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-content: space-around;
    }

    @media only screen and (min-width: 1000px) {
    .item-container, .detail-container {
        height: 80vh;
        position: sticky;
        top: 70px;
        }
    }

    .item {
	    margin:20px 20px;
	    border-style: none;
	    /* background-color: #eee; */
	    float:left;
	    border-radius: 10px;
        /* box-shadow: 2px 2px 5px gray; */
        padding: 1em;
        transition: all 0.5s;
        flex-grow: 1;
        flex-basis: 1;
        display: flex;
        align-items: center;
        justify-content: center;
     }

     .item:hover {
        box-shadow: 2px 2px 5px gray;
	    /* background-color: #ccc; */
     }

     .item-image {
        width: 100px;
        height: 100px;
        float:left;
        background-repeat: no-repeat;
        background-size: contain;
       
     }
     .item-title {
	    font-size: 20px;
     }

     .item:hover .item-text {
         display: block;
         max-width: 200px;
         transition: max-width 1s;
     }

     .item-text {
         position: relative;
         display: none;
         max-width: 0px;
     }

     .red-title {
	    text-align: center;
        color: #800;
     }

     .blue-title {
	    text-align: center;
	    color: #008;
     }

     .yellow-title {
	    text-align: center;
	    color: #888800;
     }
     
     .error-text {
	    color: red;
	    margin-left: 20px;
	    text-align:center;
     }

     .normal-text {
	    color: #090;
	    margin-left: 20px;
	    text-align:center;
     }

     .item-fraud {
	    width:30%;
	    animation: anim 1s infinite alternate;
     }

     @keyframes anim {
	    0% { opacity: 0 }
	    100% { opacity: 1 }
     }

    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-2 item-container">
           <!-- <phase-state></phase-state> -->
           <quick-control></quick-control>
        </div>
<div class="meter-detail col-lg-5 col-md-6">
<div class="card detail-container">
<div class="card-header">Meter Details</div>

    <div class="card-body">
         <div>
           <span>Meter Name: </span>
           <span><b>
                {{ $meter->name }} 
            </b></span>
        </div>
        <hr />
        <div>
           <span>Meter Number: </span>
           <span><b>
                {{ $meter->meter_number }} 
            </b></span>
        </div>
        <hr />

         <div>
           <span>Owner Phone number: </span>
           <span><b>
                {{ $meter->owner_phone_number}}
            </b></span>
        </div>
        <hr />

        <div>
           <span>Designation: </span>
           <span><b>
                {{ $meter->designation }}
            </b></span>
        </div>
        <hr />

        <div>
           <span>Address: </span>
           <span><b>
                 {{ $meter->address }}
            </b></span>
        </div>
        <hr />

        <div>
           <!-- <span>Power Comsumed: </span>
           <span><b>
                {{ $meter->power_consumed }}
            </b></span> -->
        </div>
        <hr />
       <div>
           <span>Capacity (Watts): </span>
           <span><b>
                {{ $meter->capacity }}
            </b></span>
        </div>
        <hr />
        <!-- <div>
           <span>Available Units: </span>
           <span><b>
                {{ $meter->available_units }}
            </b></span>
        </div>
        <hr /> -->
        <div>
           <!-- <span>Status: </span>
           <span><b>
                {{ $meter->status }}
            </b></span> -->
        </div>
        <a href="{{ route('customer_recharge', $meter->id)}}">
  			<button class="btn btn-success">Recharge </button>
		</a>
    </div>
</div>
</div>
    <div class="col-md-6 col-lg-4">
        <status-component> </status-component>
        <!-- <canvas style="display:none" id="myChart" width="400" height="400"></canvas>  -->
        <current-consumption-component> </current-consumption-component>
        <consumption-history> </consumption-history>
        <div class="quick-controls" >
            <!-- <example-component> </example-component> -->
            <!-- <quick-control> </quick-control> -->
            <controls> </controls>
        </div>
    </div>
</div>
</div>
       
@endsection