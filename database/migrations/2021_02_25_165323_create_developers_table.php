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

            $table->string('name');
            $table->string('number');
            $table->string('rating');

            $table->string('company_name');
            $table->string('company_number');
            $table->string('company_history');
            $table->string('company_foundation_date');
            $table->string('company_address');

            $table->string('count_workers');
            $table->string('count_machinery');

            $table->string('count_objects');
            $table->string('count_constructed_objects');
            $table->string('count_under_constructed_objects');

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
