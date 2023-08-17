<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstantMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instant_messages', function (Blueprint $table) {
            $table->id('instant_message_id');
            $table->string('user_id')->nullable();
            $table->string('instant_message_recipient_user_id')->nullable();
            $table->string('instant_message_message')->nullable();
            $table->time('instant_message_time', $precision = 0)->nullable();
            $table->string('instant_message_read')->nullable();
            $table->date('instant_message_sent', $precision = 0)->nullable();
            $table->timestamps($precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instant_messages');
    }
}
