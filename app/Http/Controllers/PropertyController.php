<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;

class PropertyController extends Controller
{
    
    public static function getProperty($name, $value=null, $save=false) {
        if(!$value) {
            return Property::where("name", $name)->get()->first();
        } else {
            $property = Property::where("name", $name)->get()->first();
            if ($property) return $property;
            else {
                if($save) {
                    setProperty($name, $value);
                }
                return $value;
            }
        }
    }

    public static function setProperty($name, $value) {
        if(PropertyController::getProperty($name)) {
            $property = PropertyController::getProperty($name);
            $property->value = $value;
            $property->save();
        } else {
            $property = new Property;
            $property->name = $name;
            $property->value = $value;
            $property->save();
        }  
    }

    public static function getAllProperties() {
        $properties = Property::all();
        /*$propertiesArray = $properties->map(function($item){
            return array($item->name=>$item->value);
        }); */

        $props = array();

        foreach ($properties as $p) {
            $props[$p->name] = $p->value;
        }
        return  $props;
    }
}
