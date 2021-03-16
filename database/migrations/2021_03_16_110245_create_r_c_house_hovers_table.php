<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRCHouseHoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_c_house_hovers', function (Blueprint $table) {
            $table->id();

            $table->string('svg')->default(env("CLIENT_URL", 'http://localhost').'/storage/images/r_c_house_hovers/no_image.img');

            $table->string('r_c_house_id')->nullable();
            $table->string('r_c_house_description_id')->nullable();
            $table->string('house_link_id')->nullable();

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
        Schema::dropIfExists('r_c_house_hovers');
    }
}
