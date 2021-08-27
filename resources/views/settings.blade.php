@extends('layouts.app')

@section('head')

@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
       <div class="md-col-6">
       @if($message)
            <div> @php echo $message;
                $props = json_decode($properties, true)['billing_rate'];
              @endphp </div>
       @endif
       <div class="card">
            <div class="card-header">{{ __('Recharge With Pin') }}</div>

            <div class="card-body">
                <form method="get" action="{{ route('settings') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="billing_rate" class="col-md-4 col-form-label text-md-right">{{ __('Billing rate') }}</label>

                        <div class="col-md-6">
                            <input value="{{ $billing_rate }}" id="billing_rate" type="number" placeholder="N/KWh" class="form-control{{ $errors->has('billing_rate') ? ' is-invalid' : '' }}" name="billing_rate" value=" {{ $properties }} " required autofocus>

                            @if ($errors->has('billing_rate'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('billing_rate') }}</strong>
                                </span>
                            @endif
                            
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" name="save" class="btn btn-primary">
                                    {{ __('SAVE') }}
                                </button>
                            </div>
                        </div>
                </form>

               
            </div>        
       </div>
    </div>
</div>

@endsection