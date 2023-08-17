<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity', function (Blueprint $table) {
            $table->id('entity_id');
            $table->bigInteger('work_order_id')->nullable();
            $table->char('entity_state', 2)->nullable();
            $table->string('entity_country')->nullable();
            $table->string('entity_jurisdiction')->nullable();
            $table->string('entity_name')->nullable();
            $table->string('entity_type')->nullable();
            $table->string('entity_file_type')->nullable();
            $table->string('entity_document_category')->nullable();
            $table->string('entity_statement_type')->nullable();
            $table->enum('entity_search_scope', ['open', 'closed', 'open+closed+dismissed'])->nullable();
            $table->string('entity_plantiff')->nullable();
            $table->string('entity_defendant')->nullable();
            $table->enum('entity_search_superior_municipal', ['yes', 'no'])->nullable();
            $table->enum('entity_search_federal_district', ['yes', 'no'])->nullable();
            $table->enum('entity_search_federal_bankruptcy', ['yes', 'no'])->nullable();
            $table->enum('entity_prepare_documents', ['yes', 'no'])->nullable();
            $table->enum('entity_corporate_kit', ['yes', 'no'])->nullable();
            $table->enum('entity_rush', ['yes', 'no'])->nullable();
            $table->enum('entity_good_standing', ['yes', 'no'])->nullable();
            $table->string('entity_good_standing_copies')->nullable();
            $table->enum('entity_registered_agent', ['yes', 'no'])->nullable();
            $table->string('entity_corporate_number')->nullable();
            $table->date('entity_file_date')->nullable();
            $table->string('entity_numbers_of_shares')->nullable();
            $table->enum('entity_ucc_monitor_status', ['Enabled', 'Disabled', 'Another'])->nullable();
            $table->enum('entity_ucc_monitor_type', ['Requested', 'Automatic'])->nullable();
            $table->integer('entity_contact_id')->nullable();
            $table->double('entity_alert_price')->nullable();
            $table->string('entity_rush_type')->nullable();
            $table->enum('entity_alert_primary', ['true', 'false'])->nullable();
            $table->text('entity_official_name')->nullable();
            $table->text('entity_lien_type')->nullable();
            $table->text('entity_lien_secured_party')->nullable();
            $table->text('entity_lien_creditor')->nullable();
            $table->text('entity_search_type')->nullable();
            $table->integer('jurisdiction_id')->nullable();
            $table->integer('entity_primary_service')->nullable();
            $table->integer('order_id')->nullable();
            $table->enum('entity_complete', ['true', 'false'])->nullable();
            $table->integer('invoice_id')->nullable();
            $table->string('entity_status')->nullable();
            $table->integer('entity_owner_user_id')->nullable();
            $table->dateTime('entity_follow_up_date')->nullable();
            $table->dateTime('entity_submit_date')->nullable();
            $table->integer('bill_group_id')->nullable();
            $table->enum('entity_delete', ['false', 'true'])->nullable();
            $table->dateTime('entity_approve_time')->nullable();
            $table->dateTime('entity_close_time')->nullable();
            $table->dateTime('entity_pending_time')->nullable();
            $table->dateTime('entity_invoice_time')->nullable();
            $table->dateTime('entity_quote_time')->nullable();
            $table->dateTime('entity_review_time')->nullable();
            $table->integer('entity_approve_owner_id')->nullable();
            $table->integer('entity_close_owner_id')->nullable();
            $table->integer('entity_pending_owner_id')->nullable();
            $table->integer('entity_invoice_owner_id')->nullable();
            $table->integer('entity_quote_owner_id')->nullable();
            $table->integer('entity_review_owner_id')->nullable();
            $table->dateTime('entity_new_time')->nullable();
            $table->integer('entity_new_owner_id')->nullable();
            $table->text('entity_location')->nullable();
            $table->integer('portal_entity_id')->nullable();
            $table->enum('entity_service_form_saved', ['true', 'false'])->nullable();
            $table->enum('entity_file_date_bypass', ['true', 'false'])->nullable();
            $table->text('entity_tag')->nullable();
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
        Schema::dropIfExists('entity');
    }
}
