<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidentialComplexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residential_complexes', function (Blueprint $table) {
            $table->id();
            $table->string('image')->default(env("CLIENT_URL", 'http://localhost').'/storage/images/residential_complexes/no_image.jpg');
            $table->string('name');
            $table->string('title');
            $table->string('rating')->nullable();

            $table->string('address')->nullable();

            $table->string('about_title');
            $table->string('about_description');

            $table->string('advantages_title')->default('Наши приемущества');
            $table->string('comments_title')->default('Отзывы наших клиентов');

            $table->string('construction_start_date')->nullable();
            $table->string('construction_finish_date')->nullable();

            $table->string('marker_id')->nullable();
            $table->string('year_id')->nullable();
            $table->string('developer_id')->nullable();

            $table->boolean('bestseller')->nullable();

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
        Schema::dropIfExists('residential_complexes');
    }
}
