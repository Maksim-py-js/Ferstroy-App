<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevelopersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developers', function (Blueprint $table) {
            $table->id();

            $table->string('logo')->default(env("CLIENT_URL", 'http://localhost').'/storage/images/developers/no_image.svg');

            $table->string('name');
            $table->string('number')->nullable();
            $table->string('rating')->nullable();
            $table->string('rating_votes')->nullable();

            $table->string('company_name')->nullable();
            $table->string('company_number')->nullable();
            $table->string('company_history')->nullable();
            $table->string('company_foundation_date')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_website')->nullable();
            $table->string('company_about_title')->nullable();
            $table->string('company_about_text')->nullable();

            $table->string('count_workers')->nullable();
            $table->string('count_machinery')->nullable();

            $table->string('count_objects')->nullable();
            $table->string('count_constructed_objects')->nullable();
            $table->string('count_under_constructed_objects')->nullable();

            $table->string('email')->nullable();
            $table->string('marker_id')->nullable();

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
        Schema::dropIfExists('developers');
    }
}
