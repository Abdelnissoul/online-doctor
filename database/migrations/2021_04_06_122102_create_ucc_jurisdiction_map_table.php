<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUccJurisdictionMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ucc_jurisdiction_map', function (Blueprint $table) {
            $table->id('ucc_jurisdiction_map_id');
            $table->integer('jurisdiction_county_id')->nullable();
            $table->string('jurisdiction_name')->nullable();
            $table->string('federal_tax_lien_search')->nullable();
            $table->string('fixture_dot_search')->nullable();
            $table->string('judgment_lien_search')->nullable();
            $table->string('mechanic_lien_search')->nullable();
            $table->string('state_tax_lien_search')->nullable();

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
        Schema::dropIfExists('ucc_jurisdiction_map');
    }
}
