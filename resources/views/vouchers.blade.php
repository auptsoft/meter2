@extends('layouts.app')

@section('head')
<style>
    .row {
        margin-left:20px;
        margin-right:20px;
    }

    .v-used {
        margin-top : 20px;
    }
    
    .v-container {
        display:grid;
    }
    
    .v-header {
        
    }

    .v-col-1 {
        grid-column-start:1;
        grid-column-end:2;
    }

    .v-col-2 {
        grid-column-start:2;
        grid-column-end:3;
    }

    .v-col-3 {
        grid-column-start:3;
        grid-column-end:4;
    }

    .v-col-4 {
        grid-column-start:4;
        grid-column-end:5;
    }

    .v-col-5 {
        grid-column: 5/6;
    }

    .v-col-1, .v-col-2, .v-col-2, .v-col-3, .v-col-4, .v-col-5 {
        margin:10px;
    }
</style>
@endsection

@section('content')



<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('Unused Vouchers') }}
            </div>
            <div class="card-body">
                <div class="v-container">
                    <div class="v-col-1 v-header">S/N </div>
                    <div class="v-col-2 v-header">Pin </div>
                    <div class="v-col-3 v-header">Unit </div>
                    <div class="v-col-4 v-header"> Created At </div>
                    @foreach($unusedVouchers as $voucher)
                        <!--<div> {{ $voucher->readable_pin }} </div> -->
                        <div class="v-col-1 v-header"> {{ $loop->index+1 }} </div>
                        <div class="v-col-2 v-header">{{ $voucher->readable_pin }} </div>
                        <div class="v-col-3 v-header">{{ $voucher->worth }} </div>
                        <div class="v-col-4 v-header"> {{ $voucher->created_at }} </div>
                        <div class="v-col-5">
                            <form method="post" action="{{ route('deleteVoucher', $voucher->id) }} ">
                                @csrf
                                <input type="text" name="id" value="{{ $voucher->id }}" style="display:none" />
                                <input type="submit" name="delete" class="btn btn-primary" value="Delete" /> 
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card v-used">
            <div class="card-header">{{ __('Used Vouchers') }}
            </div>
            <div class="card-body">
                <div class="v-container">
                    <div class="v-col-1 v-header">S/N </div>
                    <div class="v-col-2 v-header">Pin </div>
                    <div class="v-col-3 v-header">Unit </div>
                    <div class="v-col-4 v-header"> Used At </div>
                    @foreach($usedVouchers as $voucher)
                        <!--<div> {{ $voucher->readable_pin }} </div> -->
                        <div class="v-col-1 v-header"> {{ $loop->index+1 }} </div>
                        <div class="v-col-2 v-header">{{ $voucher->readable_pin }} </div>
                        <div class="v-col-3 v-header">{{ $voucher->worth }} </div>
                        <div class="v-col-4 v-header"> {{ $voucher->updated_at }} </div>
                        <div class="v-col-5">
                            <form method="post" action="{{ route('deleteVoucher', $voucher->id) }} ">
                                @csrf
                                <input type="text" name="id" value="{{ $voucher->id }}" style="display:none" />
                                <input type="submit" name="delete" class="btn btn-primary" value="Delete" /> 
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>  

    <div class="col-md-4">
        <form method="post" action="{{route('generateVoucher')}}">
            @csrf
            <div class="form-group row">
                <label for="units" class="col-md-4 col-form-label text-md-right">{{ __('Units') }}</label>
                <div class="col-md-6">
                    <input id="units" type="number" value="500" class="form-control{{ $errors->has('units') ? ' is-invalid' : '' }}" name="units" value="{{ old('units') }}" required autofocus>
                    @if ($errors->has('units'))
                         <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('units') }}</strong>
                        </span>
                    @endif                     
                </div>
            </div>
            <div class="form-group row">
                <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('quantity') }}</label>
                <div class="col-md-6">
                    <input id="quantity" type="number" value="10" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" name="quantity" value="{{ old('quantity') }}" required autofocus>
                    @if ($errors->has('quantity'))
                         <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('quantity') }}</strong>
                        </span>
                    @endif                     
                </div>
            </div>
             
             <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <input name="generate_pins" type="submit" class="btn btn-primary" value="Generate Pins" />
                </div>
            </div>
        </form>
    </div>
</div>   
@endsection