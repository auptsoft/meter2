<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Voucher;


class VoucherController extends Controller
{
    public function showAll(Request $request) {
       
        $unusedVouchers = Voucher::where('used', false)->get();
        $usedVouchers = Voucher::where('used', true)->get();

        return view("vouchers", ['unusedVouchers'=>$unusedVouchers, 'usedVouchers'=>$usedVouchers]);
    }


    public function generate(Request $request) {
        $action = $request->input("generate_pins");
        if($action) {
            $units = $request->input('units');
            $quantity = $request->input('quantity');
            VoucherController::generateManyVoucher($units, $quantity);
            return back();
        }
    }

    public static function generateVoucher() {
        $num1 = rand(1000, 9999)."";
        $num2 = rand(1000, 9999)."";
        $num3 = rand(1000, 9999)."";
        $num4 = rand(1000, 9999)."";
        $num5 = rand(1000, 9999)."";

        

        $pin = $num1.$num2.$num3.$num4.$num5;
        $readablePin = $num1." ".$num2." ".$num3." ".$num4." ".$num5;

        return array("pin"=>$pin, "readablePin"=>$readablePin);
    }

    public function generateManyVoucher($amount, $number) {
        for($i=0; $i<$number; $i++) {
            $gVoucher = VoucherController::generateVoucher();
            $voucher = new Voucher;
            $voucher->pin = $gVoucher["pin"];
            $voucher->readable_pin = $gVoucher["readablePin"];
            $voucher->worth = $amount;

            $voucher->save();
        }
    }

    public function deleteVoucher(Request $request) {
        $id = $request->input("id");
        $voucher = Voucher::find($id);
        if($voucher) {
            $voucher->delete();
            return back();
        } else {
            return "could not found voucher";
        }
    }
}
