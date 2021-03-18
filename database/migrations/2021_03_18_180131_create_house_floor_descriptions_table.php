<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseFloorDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_floor_descriptions', function (Blueprint $table) {
            $table->id();

            $table->string('number');
            $table->string('count_appartments');
            $table->string('house_id');

            $table->string('positionTop')->nullable();
            $table->string('positionRight')->nullable();
            $table->string('positionBottom')->nullable();
            $table->string('positionLeft')->nullable();

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
        Schema::dropIfExists('house_floor_descriptions');
    }
}
