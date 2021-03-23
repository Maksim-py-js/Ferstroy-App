<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appartments', function (Blueprint $table) {
            $table->id();

            $table->string('image')->default(env("CLIENT_URL", 'http://localhost').'/storage/images/appartments/no_image.img');

            $table->string('appartment_number');
            $table->string('square');
            $table->longText('description');
            $table->string('phone_number');

            $table->string('price')->nullable();
            $table->string('roomines')->nullable();
            $table->string('variety')->nullable();
            $table->string('construction_start_date')->nullable();
            $table->string('construction_finish_date')->nullable();


            $table->string('floor_id');

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
        Schema::dropIfExists('appartments');
    }
}
