<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurisdictionSpecialNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurisdiction_special_note', function (Blueprint $table) {
            $table->id('jurisdiction_special_note_id');
            $table->integer('user_id')->nullable();
            $table->string('jurisdiction_special_note_country')->nullable();
            $table->string('jurisdiction_special_note_state')->nullable();
            $table->string('jurisdiction_special_note_type')->nullable();
            $table->string('jurisdiction_special_note_text')->nullable();
            $table->string('jurisdiction_special_note_subtype')->nullable();
            $table->string('jurisdiction_special_note_subsubtype')->nullable();
            $table->timestamp('jurisdiction_special_note_time')->nullable();

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
        Schema::dropIfExists('jurisdiction_special_note');
    }
}
