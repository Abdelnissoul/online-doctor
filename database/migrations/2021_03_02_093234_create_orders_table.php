<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->integer('order_cid')->nullable();
            $table->integer('entity_id')->nullable();
            $table->integer('order_primary_contact_id')->nullable();
            $table->enum('order_status', ['New', 'Pending Docs', 'In Process', 'Closed'])->nullable(); // baki
            $table->timestamp('order_create_time')->nullable();
            $table->enum('order_type', ['Email', 'Phone', 'Fax', 'Portail', 'Quote'])->nullable();
            $table->bigInteger('order_create_user_id')->nullable();
            $table->enum('order_delete', ['true', 'false'])->nullable();
            $table->timestamp('order_delete_time')->nullable();
            $table->longText('order_summary')->nullable();
            $table->text('order_note')->nullable();
            $table->integer('order_delete_user_id')->nullable();
            $table->string('order_client_ref_num')->nullable();
            $table->string('order_matter_num')->nullable();
            $table->enum('order_one_invoice', ['true', 'false'])->nullable();
            $table->integer('order_invoice_id')->nullable();
            $table->text('order_additional_note')->nullable();
            $table->enum('order_invoice_by_state', ['true', 'false'])->nullable();
            $table->text('order_invoice_override')->nullable();
            $table->text('order_email_addresses')->nullable();
            $table->text('order_addresses')->nullable();
            $table->text('order_account_number')->nullable();
            $table->enum('order_shipping_type', ['Regular Mail', 'FedEx', 'UPS', 'Email Only'])->nullable();
            $table->integer('order_owner_user_id')->nullable();
            $table->enum('order_billing_type', ['All In One', 'By Work Order'])->nullable();
            $table->enum('order_work_order_type', ['All In One', 'By State', 'By Jurisdiction'])->nullable();
            $table->integer('order_last_email_user_id')->nullable();
            $table->dateTime('order_close_time')->nullable();
            $table->text('order_care_of')->nullable();
            $table->enum('order_sop', ['true', 'false'])->nullable();
            $table->dateTime('order_assign_time')->nullable();
            $table->date('order_reopen_time')->nullable();
            $table->enum('order_reopened', ['true', 'false'])->nullable();
            $table->text('order_special_note')->nullable();
            $table->integer('order_original_owner')->nullable();
            $table->enum('order_recurring', ['true', 'false'])->nullable();

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
        Schema::dropIfExists('orders');
    }
}
