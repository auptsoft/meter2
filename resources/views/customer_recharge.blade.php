@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Recharge With Pin') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('pin_recharge') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="pin" class="col-md-4 col-form-label text-md-right">{{ __('Pin') }}</label>

                            <div class="col-md-6">
                                <input id="pin" type="number" placeholder="e.g 2324 2382 8182 8329 8293" class="form-control{{ $errors->has('pin') ? ' is-invalid' : '' }}" name="pin" value="{{ old('pin') }}" required autofocus>

                                @if ($errors->has('pin'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pin') }}</strong>
                                    </span>
                                @endif
                                
                            </div>
                             <input type="text" name="id" value="{{ $meter->id }}" style="display:none" />
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('GO') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <br />

            <div class="card">
                <div class="card-header">{{ __('Online Recharge') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('pin_recharge') }}">
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
</div>
@endsection
