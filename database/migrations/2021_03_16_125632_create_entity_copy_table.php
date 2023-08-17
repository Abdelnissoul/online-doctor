<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntityCopyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_copy', function (Blueprint $table) {
            $table->id('copy_id');
            $table->bigInteger('entity_id')->nullable();
            $table->string('copy_name')->nullable();
            $table->string('copy_quantity')->nullable();
            $table->string('d_search_forward_date')->nullable();
            $table->string('entity_good_standing_type')->nullable();
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
        Schema::dropIfExists('entity_copy');
    }
}
