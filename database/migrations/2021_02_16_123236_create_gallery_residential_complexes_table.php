<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryResidentialComplexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_residential_complexes', function (Blueprint $table) {
            $table->id();
            $table->string('image')->default(env("CLIENT_URL", 'http://localhost').'/storage/images/gallery_residential_complexes/no_image.jpg');
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
        Schema::dropIfExists('gallery_residential_complexes');
    }
}
