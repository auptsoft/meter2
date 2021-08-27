@extends('layouts.app')

@section('head')
<script src="{{ asset('js/Chart.bundle.js') }}"> </script>
<style>
  .meter-item {
	  padding :10px;
	  margin : 10px;
  }
</style>

@endsection

@section('content')
    <section class="service-area section-gap" id="service">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="col-md-8 pb-40 header-text">
							<h1 >{{$title}}</h1>
							<p>
								{{$subtitle}}
							</p>
						</div>
						<div class="col-md-4">
						  <div class="search-container">
							  <form method="POST" action="{{ route('search/meter') }}">
                        		@csrf
								  <input class="search-input" type="text" name="query" placeholder="Meter name, number, or address" />
								  <button class="search-btn" type="submit" >Search</button>
							  </form>
							</div>
						</div>
					</div>
					<div class="row">
					    @foreach($meters as $meter)
						<div class="col-lg-4 col-md-6 pb-30">
							<a href="{{route('meter', $meter->id)}}">
							<div class="meter-item card">
								<h4  class="meter-item-title">{{ $meter->name}}</h4>
								<p>
									<span class="meter-number">{{$meter->meter_number}}	</span>								
									<br />
									<span class="meter-address">{{$meter->address}} </span>
									<br />
									<span class="meter-status">Capacity: {{$meter->capacity}} </span>
								</p>
								<a href="{{ route('staff_recharge', $meter->id)}}">
  									<button class="btn btn-success">Recharge </button>
								</a>
							</div>
							</a>
						</div>
						@endforeach
					<!--
						<div class="col-lg-4 col-md-6 pb-30">
							<div class="single-service">
								<h4><span class="lnr lnr-license"></span>Professional Service</h4>
								<p>
									Usage of the Internet is becoming more common due to rapid advancement of technology and power.
								</p>								
							</div>
						</div>
						<div class="col-lg-4 col-md-6 pb-30">
							<div class="single-service">
								<h4><span class="lnr lnr-phone"></span>Great Support</h4>
								<p>
									Usage of the Internet is becoming more common due to rapid advancement of technology and power.
								</p>								
							</div>
						</div>
						<div class="col-lg-4 col-md-6">
							<div class="single-service">
								<h4><span class="lnr lnr-rocket"></span>Technical Skills</h4>
								<p>
									Usage of the Internet is becoming more common due to rapid advancement of technology and power.
								</p>				
							</div>
						</div>
						<div class="col-lg-4 col-md-6">
							<div class="single-service">
								<h4><span class="lnr lnr-diamond"></span>Highly Recomended</h4>
								<p>
									Usage of the Internet is becoming more common due to rapid advancement of technology and power.
								</p>								
							</div>
						</div>
						<div class="col-lg-4 col-md-6">
							<div class="single-service">
								<h4><span class="lnr lnr-bubble"></span>Positive Reviews</h4>
								<p>
									Usage of the Internet is becoming more common due to rapid advancement of technology and power.
								</p>									
							</div>
						</div>	-->					
					</div>
				</div>	
			</section>
@endsection