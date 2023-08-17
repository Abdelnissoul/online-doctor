<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey', function (Blueprint $table) {
            $table->id('survey_id');
            $table->string('survey_name')->nullable();
            $table->string('survey_description')->nullable();
            $table->integer('survey_duration')->nullable();
            $table->date('survey_end_date')->nullable();
            $table->string('survey_active')->nullable();
            $table->string('survey_draft')->nullable();
            $table->string('survey_subject')->nullable();
            $table->string('survey_heading')->nullable();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
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
        Schema::dropIfExists('survey');
    }
}
