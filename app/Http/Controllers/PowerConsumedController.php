<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PowerConsumed;
use App\Meter;
use Carbon\Carbon;

use DateTime;

class PowerConsumedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PowerConsumed::all();
    }

    public function forMeter($meter_id) {
        return Meter::find($meter_id)->powerConsumed()->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $value = $request->input("v");
        $meter_designation = $request->input("d");

        if(!$value || !$meter_designation) return 'II';
        
        $meter = Meter::where("designation", $meter_designation)->get()->first();
        if($meter) {
            $powerConsumed = new PowerConsumed;
            $powerConsumed->power_consumed = $value;
            $powerConsumed->meter_id = $meter->id;

            $powerConsumed->save();
            $meter->power_consumed = $value;
            $meter->save();
            return 'OK';
            //return $meter->powerConsumed()->get();
        } else {
            return 'MNR';
        }
    }

    public static function getDayAveragePowerForMeter($meter_id, Carbon $date) {
        $meter = Meter::find($meter_id);
       // $d1 = $date->subDay(1);
        //$d2 = $date->addDay(2);
        if($meter) {
            $powerConsumed = $meter->powerConsumed()
                            ->where('created_at', '<', $date->addDay(1))->get()
                            ->where('created_at', '>', $date->subDay(1))
                            ->all();

            $powerConsumed = collect($powerConsumed);
            $count = $powerConsumed->count();
            
            $values = $powerConsumed->map(function($item) {
                return $item->power_consumed;
            });
            //return $meter->created_at;

            //$dt = new DateTime($meter->created_at);
        
            //return $powerConsumed;
            return $values->average();
        }
    }

    public static function getPC($meter_id, $daysAgo) {
        $date = Carbon::now();  //Carbon::parse("2019-03-10 21:00:00");
        $date->second = 0;
        $date->minute = 0;
        $date->hour = 0;
        $date->subDay($daysAgo);
        return  PowerConsumedController::getDayAveragePowerForMeter($meter_id, $date);
    }

    public static function getLastSevenDaysAverage($meter_id) {
        $avgs = array();
        for ($i=0; $i<7; $i++){
            $avgs[$i] = PowerConsumedController::getPC($meter_id, $i);
        }

        return array_reverse($avgs);
    }

    public static function getLastSevenDays() {
        $daysString = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
        $date = Carbon::now();
        $date->addDay(1);
        $days = array();
        for ($i=0; $i<7; $i++) {
            $days[$i] = $daysString[$date->subDay(1)->dayOfWeek];
        }

        return array_reverse($days);
    }

    public  function  recordData($meter, $powerConsumed)  {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
