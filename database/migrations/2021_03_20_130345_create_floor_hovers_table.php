<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFloorHoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('floor_hovers', function (Blueprint $table) {
            $table->id();

            $table->string('image')->default(env("CLIENT_URL", 'http://localhost').'/storage/images/floor_hovers/no_image.img');

            $table->string('state');
            $table->string('floor_id');
            $table->longText('appartment_id');

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
        Schema::dropIfExists('floor_hovers');
    }
}
