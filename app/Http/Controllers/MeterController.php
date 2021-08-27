<?php

namespace App\Http\Controllers;

use App\Meter;
use App\User;

use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MeterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function search(Request $request) {
        $query = $request->input('query');
        $matchesName = Meter::where('name', 'LIKE', "%$query%")->get();
        $matchesNumber = Meter::where('meter_number', 'LIKE', "%$query%")->get();
        $matchesAddress = Meter::where('address', 'LIKE', "%$query%")->get();

        $result = $matchesName->union($matchesNumber)->union($matchesAddress);

        return view('all_meters', ['meters'=>$result, 'title'=>"Search Result", 'subtitle'=>"Result for ".$query]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_meter');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|unique:meters,name',
            'meter_number'=>'required|unique:meters,meter_number|size:11',
            //'owner_phone_number'=>'required',
            'designation'=>'required|numeric|unique:meters',
            'address'=>'required',
            'capacity'=>'required|numeric',
        ]);

        if ($validator->fails()){
            return redirect('meter/create')
                    ->withErrors($validator)
                    ->withInput();
        }

        $meter = new Meter;
        $meter->name = $request->name;
        $meter->meter_number = $request->meter_number;
        $meter->owner_phone_number =  "no user"; // $request->owner_phone_number;
        $meter->designation = $request->designation;
        $meter->address = $request->address;
        $meter->capacity = $request->capacity;
        $meter->more = "";
        $meter->available_units = 0;
        $meter->status = "Just registered";
        $meter->isRunning = false;
        $meter->tag_id = 1;
        $meter->power_consumed = 0;

        $meter->save();

        return redirect("/all_meters");
    }

    public function customer_recharge($id) {
        $meter = Meter::find($id);
        if(Auth::user()->can('viewAll', Meter::class)) {
            return view('staff_recharge', ['meter'=>$meter]);
        } else {
            return view('customer_recharge', ['meter'=>$meter]);
        } 
    }

    public function staff_recharge($id) {
        $meter = Meter::find($id);
        return view('staff_recharge', ['meter'=>$meter]);
    }

    public function all_meters() {
        return view('all_meters', ['meters'=>Meter::all(), 'title'=>"All Meters", 'subtitle'=>"List of all registered meters"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('meter', ['meter'=>Meter::find($id)]);
    }

    public function meterApi($id) {
        return Meter::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function shutdown($id) {
        $meter = Meter::find($id);
        $meter->is_shutdown = 2;
        $meter->shutdown_reason = 5;
        $meter->power_consumed = 0;

        $meter->save();
        return ["message"=>"success"];
    }

    public function start($id) {
        $meter = Meter::find($id);
        $meter->is_shutdown = 1;
        $meter->shutdown_reason = 0;
        $meter->fraud_detected = 1;

        $meter->save();
        return ["message"=>"success"];
    }
}
