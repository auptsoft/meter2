<?php

use Illuminate\Database\Seeder;

use App\Property;

class PropertyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $billing_rate = new Property;
        $billing_rate->name = "billing_rate";
        $billing_rate->value = 25;
        $billing_rate->save();
    }
}
