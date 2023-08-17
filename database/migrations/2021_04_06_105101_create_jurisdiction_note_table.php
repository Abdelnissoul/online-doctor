<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurisdictionNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurisdiction_note', function (Blueprint $table) {
            $table->id('jurisdiction_note_id');
            $table->integer('jurisdiction_vendor_company_id')->nullable();
            $table->integer('jurisdiction_id')->nullable();
            $table->integer('cid')->nullable();
            $table->string('note_body')->nullable();
            $table->string('note_creator')->nullable();
            $table->string('note_creator_email')->nullable();
            $table->string('parent_type')->nullable();
            $table->timestamp('jurisdiction_note_time')->nullable();

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
        Schema::dropIfExists('jurisdiction_note');
    }
}
