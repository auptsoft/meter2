<?php

namespace App\Http\Controllers;

use App\Voucher;
use App\Meter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class RechargeController extends Controller
{
    public function useVoucher($pin) {
        $voucher = Voucher::where("pin", $pin)->get()->first();
        if($voucher) {
            return $voucher->worth;
        } else {
            return 0;
        }
    }

    public function pinRecharge(Request $request) {
        $request->validate(
            ['pin'=>'required|digits:20|exists:vouchers,pin']
        );

        $pin = trim($request->input('pin'));
        //$pin = implode(explode($pin, ' '));
        $meter = Meter::find($request->input('id')); //Auth::user()->meter()->get()->first();
        
        if ($this->recharge($pin, $meter)) {
            return redirect("/meter"); // back();
        } else {
            return redirect("/home");
        }    
            //return redirect()->route('home', ['msg'=>"Meter recharged successfully", 'class'=>'alert alert-success']);
            //return back()->withInput();
    }

    public static function recharge($pin, $meter) {
        $voucher = Voucher::where("pin", $pin)->where('used', false)->get()->first();
        if($voucher) {
            $worth = (int)$voucher->worth;
            $available_units = (int)$meter->available_units;
            $meter->available_units = $worth + $available_units;
            $meter->status = "Just Recharged";

            $voucher->used = true;
            $voucher->save();

            $meter->save();
            return $worth;
        }
        return false;

        
    }
}