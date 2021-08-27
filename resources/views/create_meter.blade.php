@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ 'Register New Meter' }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('meter/store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ 'Name' }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="meter_number" class="col-md-4 col-form-label text-md-right">{{ 'Meter Number' }}</label>

                            <div class="col-md-6">
                                <input id="meter_number" type="text" class="form-control{{ $errors->has('meter_number') ? ' is-invalid' : '' }}" name="meter_number" value="{{ old('meter_number') }}" required >

                                @if ($errors->has('meter_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('meter_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       {{-- <div class="form-group row">
                            <label for="owner_phone_number" class="col-md-4 col-form-label text-md-right">{{ 'Owner Phone Number' }}</label>

                            <div class="col-md-6">
                                <input id="owner_phone_number" type="text" class="form-control{{ $errors->has('owner_phone_number') ? ' is-invalid' : '' }}" name="owner_phone_number" value="{{ old('owner_phone_number') }}" required >

                                @if ($errors->has('owner_phone_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('owner_phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> --}}

                        <div class="form-group row">
                            <label for="designation" class="col-md-4 col-form-label text-md-right">{{ 'Designation' }}</label>

                            <div class="col-md-6">
                                <input id="designation" type="number" class="form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}" name="designation" value="{{ old('designation') }}" required >

                                @if ($errors->has('designation'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('designation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ 'Address' }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required >

                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="capacity" class="col-md-4 col-form-label text-md-right">{{ 'Capacity' }}</label>

                            <div class="col-md-6">
                                <input id="capacity" type="number" class="form-control{{ $errors->has('capacity') ? ' is-invalid' : '' }}" name="capacity" value="{{ old('capacity') }}" required >

                                @if ($errors->has('capacity'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('capacity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    {{ __('Save Meter') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
