@extends('layouts.app')

@section('content')
<!--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Recharge meter') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('reg_store_staff') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="units" class="col-md-4 col-form-label text-md-right">{{ __('units') }}</label>

                            <div class="col-md-6">
                                <input id="units" type="text" class="form-control{{ $errors->has('units') ? ' is-invalid' : '' }}" name="units" value="{{ old('units') }}" required autofocus>

                                @if ($errors->has('units'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('units') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('PAY NOW') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('reg_store_staff') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="units" class="col-md-4 col-form-label text-md-right">{{ __('units') }}</label>

                            <div class="col-md-6">
                                <input id="units" type="text" class="form-control{{ $errors->has('units') ? ' is-invalid' : '' }}" name="units" value="{{ old('units') }}" required autofocus>

                                @if ($errors->has('units'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('units') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('PAY NOW') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --> 
  @include('customer_recharge', ['meter'=> $meter]);
@endsection
