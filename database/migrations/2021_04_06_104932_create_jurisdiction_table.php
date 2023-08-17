<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurisdictionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurisdiction', function (Blueprint $table) {
            $table->id('jurisdiction_id');
            $table->integer('jurisdiction_county_id')->nullable();
            $table->string('county_name')->nullable();
            $table->string('county_division')->nullable();
            $table->string('county_service')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('jurisdiction_state')->nullable();
            $table->string('jurisdiction_country_state')->nullable();
            $table->string('county_court_division')->nullable();
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
        Schema::dropIfExists('jurisdiction');
    }
}
