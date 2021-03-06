<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidentialComplexHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residential_complex_houses', function (Blueprint $table) {
            $table->id();
            $table->string('svg')->default(env("CLIENT_URL", 'http://localhost').'/storage/images/residential_complex_houses/no_image.jpg');
            $table->string('residential_complex_id')->nullable();
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
        Schema::dropIfExists('residential_complex_houses');
    }
}
