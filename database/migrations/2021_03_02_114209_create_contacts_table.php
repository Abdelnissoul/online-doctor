<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id('contact_id');
            $table->integer('contact_cid')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('contact_referred_by')->nullable();
            $table->string('contact_title')->nullable();
            $table->string('contact_fname')->nullable();
            $table->string('contact_lname')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_password')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_fax')->nullable();
            $table->string('contact_dept')->nullable();
            $table->string('contact_position')->nullable();
            $table->string('contact_area_of_law')->nullable();
            $table->enum('contact_role', ['Administrator', 'Accountant', 'Manager', 'US'])->nullable();
            $table->enum('contact_card_pmt', ['true', 'false'])->nullable();
            $table->enum('contact_status', ['active', 'inactive'])->nullable();
            $table->string('contact_update_hash')->nullable();
            $table->tinyInteger('contact_loyalty_member')->nullable();
            $table->enum('contact_si_enabled', ['true', 'false'])->nullable();
            $table->enum('contact_ucc_enabled', ['true', 'false'])->nullable();
            $table->text('contact_special_instruction')->nullable();
            $table->text('contact_notes')->nullable();
            $table->enum('contact_inactive', ['true', 'false'])->nullable();
            $table->integer('contact_cc')->nullable();
            $table->enum('contact_bulk_order', ['true', 'false'])->nullable();
            $table->enum('contact_order_response', ['true', 'false'])->nullable();
            $table->enum('contact_receive_statement', ['false', 'true'])->nullable();
            $table->integer('company_location_id')->nullable();
            $table->enum('contact_locked', ['false', 'true'])->nullable();
            $table->enum('contact_portal_only', ['false', 'true'])->nullable();
            $table->enum('contact_auto_pay', ['false', 'true'])->nullable();
            $table->integer('contact_group_id')->nullable();
            $table->enum('contact_weekly_billing', ['false', 'true'])->nullable();
            $table->timestamp('contact_create_time')->nullable();
            $table->enum('contact_portal_tutorial', ['true', 'false'])->nullable();
            $table->enum('contact_create_email_sent', ['false', 'true'])->nullable();
            $table->text('contact_ssn')->nullable();
            $table->enum('contact_tos_agree', ['false', 'true'])->nullable();
            $table->enum('contact_receive_survey', ['true', 'false'])->nullable();
            $table->enum('contact_auto_pay_type', ['Billing', 'Billing_Info'])->nullable();
            $table->integer('contact_auto_pay_id')->nullable();
            $table->string('contact_extension')->nullable();
            $table->enum('weekly_billing', ['true', 'false'])->nullable();
            $table->integer('weekly_billing_user_id')->nullable();
            $table->enum('receive_statement_type', ['company', 'contact'])->nullable();
            $table->enum('receive_statement_frequency', ['monthly', 'weekly'])->nullable();
            $table->enum('receive_statement_day', ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'])->nullable();
            $table->text('receive_statement_email')->nullable();
            $table->string('weekly_billing_email')->nullable();
            $table->string('receive_statement_format')->nullable();
            $table->string('receive_statement_range')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
