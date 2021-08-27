<?php

namespace App\Http\Controllers;

use App\User;
use App\RoleUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Meter;

class UserController extends Controller
{
    public function create() {
        return view('auth/register_customer'); 
    }

    public function createStaff() {
        return view('auth/register_staff'); 
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'meter_number' => 'required|string|size:11|exists:meters',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()){
            return redirect('reg_customer')
                    ->withErrors($validator)
                    ->withInput();
        } 

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->meter_number = $request->meter_number;
        //$user->phoneNumber = $request->phone_number;
        $user->password = Hash::make($request->password);

        $user->save(); 

        $meter = Meter::where([["meter_number", "=", $request->meter_number]])->get()->first();
        $meter->owner_phone_number = $request->phone_number;
        $meter->save();
        
        $roleUser = new RoleUser;
        $roleUser->user_id = $user->id;
        $roleUser->role_id = 3;

        $roleUser->save();

        return redirect('/home');
    }

    public function storeStaff(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()){
            return redirect('reg_staff')
                    ->withErrors($validator)
                    ->withInput();
        } 

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->meter_number = '0000000000';
        $user->password = Hash::make($request->password);

        $user->save(); 
        
        $roleUser = new RoleUser;
        $roleUser->user_id = $user->id;
        $roleUser->role_id = $request->input('role');

        $roleUser->save();

        return redirect('/home');
    }

    public function meter() {
        if (Auth::user()->can('ownMeter', "App\Meter")) {
            return view('meter', ['meter'=>Auth::user()->meter]);
        } else {
            return redirect('all_meters');
        }   
    }
}
