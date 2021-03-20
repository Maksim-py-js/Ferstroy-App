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

            $table->longText('floor_id');

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
