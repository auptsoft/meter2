<?php

namespace App\Http\Controllers;

use App\FaultStatus;
use Illuminate\Http\Request;
use App\Meter;
use App\Property;
use Carbon\Carbon;
use App\PowerConsumed;

class RequestController extends Controller
{
    public function handleRequest(Request $request) {
        $data = $request->input('data');

        $designation = substr($data, 0, 5);
        $currentPowerConsumption = (int)substr($data, 5, 5);
        $redPhaseActive = substr($data, 10, 1);
        $bluePhaseActive = substr($data, 11, 1);
        $yellowPhaseActive = substr($data, 12, 1);
        $fraudDetected = substr($data, 13, 1);
        $currentPhase = substr($data, 14, 1);

        // meterModel.availableAmount = sendableString.substring(5, 9);
        // meterModel.meterState = sendableString.substring(9, 10);
        // meterModel.reason = sendableString.substring(10, 11);

        $meter = Meter::where('designation', $designation)->get()->first();
        if($meter) {

            $meterState = "";
            $reason = "";
            $capacity = "";

            $availableAmount = $meter->availableAmount;
            $lastPowerConsumed = $meter->power_consumed;
            $billing_rate = (float)PropertyController::getProperty('billing_rate');
            $lastUpdate = $meter->updated_at; 
            $currentTime = Carbon::now();

            $duration = $currentTime->diffInSeconds($lastUpdate);
            
            $unitConsumed = (((int)$currentPowerConsumption + (int)$lastPowerConsumed)/2) 
                            * ($duration/3600) * $billing_rate;

            if($unitConsumed >= $meter->available_units) {
                $meter->available_units = 0;
                $meter->status = "Shutdown due to insufficent units. Please recharge now";

                $meter->state = "0";
                $reason = "1";
                
            } else {
                $meter->available_units = $meter->available_units - $unitConsumed;
                $meter->status = "Active";
            }

        }
        

        // meterModel.powerConsumption = sendableString.substring(12, 16);
        // meterModel.redPhaseActive = sendableString.substring(16, 17);
        // meterModel.bluePhaseActive = sendableString.substring(17, 18);
        // meterModel.yellowPhaseActive = sendableString.substring(18, 19);
        // meterModel.fraudDetected = sendableString.substring(19, 20);
        // meterModel.currentPhase = sendableString.substring(20, 21);
        // meterModel.capacity = sendableString.substring(22, 26);

    }

    //public function sendResponse()

    public function appendZeros(string $inputStr, int $noOfChars) {
        while (strlen("$inputStr") < $noOfChars) {
            $inputStr = '0'.$inputStr;
        }
        return $inputStr;
    }

    public function fault(Request $request) {
        $data = $request->input('data');
        $dataArray = explode('=', $data);

        $res = FaultStatus::find(1);
        if(!$res) {
            $res = new FaultStatus;
        }

        if($dataArray[0]==0) {
            $res->red_status = $dataArray[1];
        }
        if($dataArray[0]==1) {
            $res->yellow_status = $dataArray[1];
        }
        if($dataArray[0]==2) {
            $res->blue_status = $dataArray[1];
        }
        if($dataArray[0]==3) {
            $res->neutral_status = $dataArray[1];
        }

        $res->save();
        
        return "$res->red_status-$res->yellow_status-$res->blue_status";
    }

    public function getFault() {
        $res = FaultStatus::find(1);
        if (!$res) {
            $res = [];
        }
        return ['status'=>'success', 'data'=>$res];
    }

    public function gateway(Request $request) {

        //return $request;
        //$mt = new Meter;
        //return $this->meterStatus($mt);

        $data = $request->input('data');
        //return $data;
        $dataArray = explode('>', $data);

        //return $data;

        $type = $dataArray[1];
        if ($type == "#") {
            $designation = intval($dataArray[2]);
            $current = intval($dataArray[3])/1000;
            $voltage = intval($dataArray[4])/10;
            $redPhaseActive = intval($dataArray[5]);
            $yellowPhaseActive = intval($dataArray[6]);
            $bluePhaseActive = intval($dataArray[7]);          
            $fraudDetected = intval($dataArray[8]);
            $currentPhase = intval($dataArray[9]);
            
            $freq =  intval($dataArray[10], 16);
            $pf = intval($dataArray[11], 16);
            
            $frequency = $freq/10;
            $powerFactor = $pf/10;

            // $frequency = ($dataArray[10][0]*256+$dataArray[10][1])/10;
            // $powerFactor = ($dataArray[11][0]*256+$dataArray[11][1])/10;
            
            //return "hello";
            /*echo " $designation - $powerConsumed - $redPhaseActive - 
                    $bluePhaseActive - $yellowPhaseActive - $fraudDetected
                    - $currentPhase"; */
            
            //return $frequency . " ".$powerFactor;
            $powerConsumed = $current*$voltage; //intval($dataArray[2]);
            //return $powerConsumed;
            $meter = Meter::where('designation', $designation)->get()->first();
            if ($meter) {
                
                $billing_rate = (float)PropertyController::getProperty('billing_rate')->value;
                
                $unitConsumed = $this->computePowerConsumed($meter, $powerConsumed, $billing_rate);
                
               

                $phaseArray = [$redPhaseActive, $bluePhaseActive, $yellowPhaseActive];

                $isShutdown = 1;
                $shutdownReason = 0;
                $currentAvailableUnit = (float)$meter->available_units - (float)$unitConsumed;
                
                if ($meter->shutdown_reason == 5) {
                    $isShutdown = 2;
                    $shutdownReason = 5;
                } else if ($meter->fraud_detected == 2) {
                    $isShutdown = 2;
                    $shutdownReason = 1;
                    $fraudDetected = 2;
                } else if ($fraudDetected == 2) {
                    $isShutdown = 2;
                    $shutdownReason = 1;
                } else if($currentAvailableUnit < 0 ) {
                    $currentAvailableUnit = 0;
                    $isShutdown = 2;
                    $shutdownReason = 2;
                }

                /*if ($phaseArray[$currentPhase-1] == 0) {
                    $isShutdown = 2;
                    $shutdownReason = 3;
                } */

                else if ($powerConsumed > $meter->capacity) {
                    $isShutdown = 2;
                    $shutdownReason = 4;
                }
             
                if ($isShutdown != 1) {
                    $powerConsumed = 0;
                }

                //return $shutdownReason;

                $meter->available_units = $currentAvailableUnit;

                $meter->current = $current;
                $meter->voltage = $voltage;
                $meter->power_consumed = $powerConsumed;
                $meter->random = rand(1000, 9999)."";
                $meter->red_phase_active = $redPhaseActive;
                $meter->blue_phase_active = $bluePhaseActive;
                $meter->yellow_phase_active = $yellowPhaseActive;
                $meter->fraud_detected = $fraudDetected;
                $meter->current_phase = $currentPhase;
                $meter->is_shutdown = $isShutdown;
                $meter->shutdown_reason = $shutdownReason;

                $meter->save();

                $powCon = new PowerConsumed;
                $powCon->power_consumed = $powerConsumed;
                $powCon->current = $current;
                $powCon->voltage = $voltage;
                $powCon->power_factor = $powerFactor;
                $powCon->frequency = $frequency;
                $powCon->meter_id = $meter->id;

                $powCon->save();
                
                return $this->meterStatus($meter);
            } else {
                echo 'E';
            }
        } else if ($type == "R") {
            $designation = intval($dataArray[1]);
            
            $meter = Meter::where('designation', $designation)->get()->first();
            if ($meter) {
                $rechargePin = $dataArray[2];
                if (intval($rechargePin) == 0) {
                    $this->rechargeStatus($meter, 999);
                } 
                return $this->rechargeStatus($meter, RechargeController::recharge($rechargePin, $meter));           
            }
        } else if ($type == "A") {

        }
    }

    public function computePowerConsumed($meter, $currentPowerConsumption, $billing_rate) {
            $lastPowerConsumed = $meter->power_consumed;
            if ($lastPowerConsumed == 0) return 0;
            $lastUpdate = $meter->updated_at; 
            $currentTime = Carbon::now();

            $duration = $currentTime->diffInSeconds($lastUpdate);
            
            $unitConsumed = (((int)$currentPowerConsumption + (int)$lastPowerConsumed)/2) 
                            * ($duration) * $billing_rate / (1000 * 3600);
            return $unitConsumed;
    }

    public function meterStatus($meter) {
        //return "hello"; 
        $output = $this->appendZeros($meter->designation, 5)
                    .$meter->is_shutdown
                    .$meter->shutdown_reason
                    .$this->getPhaseStatus($meter->red_phase_active, $meter->yellow_phase_active, $meter->blue_phase_active)
                    // .$meter->red_phase_active
                    // .$meter->blue_phase_active
                    // .$meter->yellow_phase_active
                    .$this->appendZeros((int)$meter->available_units.'', 5)
                    .$this->appendZeros((int)$meter->power_consumed.'', 5); 
        return $output;
    }

    public function rechargeStatus($meter, $rechargeStatus) {    
        $worth = $rechargeStatus ? $rechargeStatus : '0';
        //return $worth;
        $output =  $this->appendZeros($meter->designation, 5)
                    .$this->appendZeros((int)$meter->available_units."", 5)
                    .$this->appendZeros($worth, 5)
                    .$this->appendZeros($meter->power_consumed, 5)
                    .$meter->red_phase_active
                    .$meter->yellow_phase_active
                    .$meter->blue_phase_active
                    .$meter->fraud_detected
                    .$meter->is_shutdown
                    .$meter->shutdown_reason; 

        return $output;
    }

    function getPhaseStatus($red, $yellow, $blue) {
        if($red=='2'&& $yellow=='2' && $blue=='2'){
            return 1;
        } else if($red=='2'&& $yellow=='2' && $blue=='1'){
            return 2;
        } else if($red=='2'&& $yellow=='1' && $blue=='2'){
            return 3;
        } else if($red=='2'&& $yellow=='1' && $blue=='1'){
            return 4;
        } else if($red=='1'&& $yellow=='2' && $blue=='2'){
            return 5;
        } else if($red=='1'&& $yellow=='2' && $blue=='1'){
            return 6;
        } else if($red=='1'&& $yellow=='1' && $blue=='2'){
            return 7;
        } else if($red=='1'&& $yellow=='1' && $blue=='1'){
            return 8;
        }
    }
}
