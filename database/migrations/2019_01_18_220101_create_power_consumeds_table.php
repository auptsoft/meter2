<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePowerConsumedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('power_consumeds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('power_consumed');
            $table->double('current');
            $table->double('voltage');
            $table->double('power_factor');
            $table->double('frequency');
            $table->integer('meter_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('power_consumeds');
    }
}
