<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurisdictionCompanyMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurisdiction_company_map', function (Blueprint $table) {
            $table->id('jurisdiction_company_map_id');
            $table->integer('jurisdiction_county_id')->nullable();
            $table->integer('jurisdiction_vendor_company_id')->nullable();
            $table->integer('cid')->nullable();
            $table->integer('jurisdiction_rank')->nullable();
            $table->integer('country_id')->nullable();

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
        Schema::dropIfExists('jurisdiction_company_map');
    }
}
