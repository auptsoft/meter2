<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('meter_number');
            $table->string('owner_phone_number');
            $table->integer('designation');
            $table->text('address');
            $table->double('power_consumed');
            $table->double('current')->default(0);
            $table->double('voltage')->default(0);
            $table->integer('capacity');
            $table->double('available_units');
            $table->boolean('isRunning');
            $table->string('status');
            $table->text('more');
            $table->integer('tag_id');

            $table->string('random')->default('1234');

            $table->integer('red_phase_active')->default('0'); //can be 0 or 1
            $table->integer('blue_phase_active')->default('0'); //can be 0 or 1
            $table->integer('yellow_phase_active')->default('0'); //can be 0 or 1
            $table->integer('fraud_detected')->default('0'); //can be 0 or 1
            $table->integer('current_phase')->default('1'); // can be 1, 2 or 3
            
            $table->integer('is_shutdown')->default('1'); // 1 for normal 2 for fault
            $table->integer('shutdown_reason')->default('0'); /**  
             * can be 1 for 'fraud detection'
             *       2 for unit exhaustion
             *       3 for current phase down
             *       4 for energy overload
             *       5 for meter shutdown by admin
             */

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
        Schema::dropIfExists('meters');
    }
}
