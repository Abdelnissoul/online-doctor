<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQbItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qb_items', function (Blueprint $table) {
            $table->id();
            $table->string('isactive')->nullable();
            $table->string('type')->nullable();
            $table->string('listid')->nullable();
            $table->string('name')->nullable();
            $table->decimal('price', $precision = 10, $scale = 2)->nullable();
            $table->string('desc')->nullable();
            $table->string('editsequence')->nullable();
            $table->string('old_listid')->nullable();
            $table->string('qb_item_service_item')->nullable();
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
        Schema::dropIfExists('qb_items');
    }
}
