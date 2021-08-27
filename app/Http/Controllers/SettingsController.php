<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function showPage(Request $request) {  
        $message = null;
        if($request->input("billing_rate")) {
            $billing_rate = $request->input("billing_rate");
            //return $billing_rate;
            PropertyController::setProperty("billing_rate", $billing_rate);
            $message = '<div class="alert alert-success"> Settings saved successfully </div>';
        }

        return view('settings', ['properties'=>json_encode(PropertyController::getAllProperties()), "message"=>$message,'billing_rate'=>PropertyController::getProperty('billing_rate', 20)]);
    }
}
