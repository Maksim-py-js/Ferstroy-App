<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseHoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_hovers', function (Blueprint $table) {
            $table->id();
            $table->string('svg')->default(env("CLIENT_URL", 'http://localhost').'/storage/images/house_hovers/no_image.img');

            $table->string('house_id')->nullable();
            $table->string('floor_id')->nullable();

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
        Schema::dropIfExists('house_hovers');
    }
}
