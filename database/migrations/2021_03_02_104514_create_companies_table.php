<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id('cid');
            $table->string('clientid')->nullable();
            $table->text('company')->nullable();
            $table->text('street1')->nullable();
            $table->text('street2')->nullable();
            $table->string('city')->nullable();
            $table->string('state_abbr')->nullable();
            $table->string('zip')->nullable();
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('fedex')->nullable();
            $table->enum('type', ['client', 'vendor', 'both'])->nullable();
            $table->string('listid')->nullable();
            $table->string('editsequence')->nullable();
            $table->text('special_instructions')->nullable();
            $table->enum('company_weekly_billing', ['true', 'false'])->nullable();
            $table->integer('company_weekly_billing_user_id')->nullable();
            $table->enum('company_bulk_order', ['true', 'false'])->nullable();
            $table->float('company_not_to_exceed')->nullable();
            $table->decimal('company_starting_balance', $precision = 8, $scale = 2)->nullable();
            $table->integer('account_id')->nullable();
            $table->enum('company_locked', ['false', 'true'])->nullable();
            $table->text('company_accounting_note')->nullable();
            $table->text('vendor_account_number')->nullable();
            $table->enum('company_special_read', ['true', 'false'])->nullable();
            $table->enum('company_auto_custom_price', ['true', 'false'])->nullable();
            $table->integer('customer_type_id')->nullable();
            $table->enum('company_cc_surcharge', ['true', 'false'])->nullable();
            $table->timestamp('company_create_time')->nullable();
            $table->enum('company_active', ['true', 'false'])->nullable();
            $table->text('company_country')->nullable();
            $table->text('company_tax_id')->nullable();
            $table->enum('portal_ucc_1_override', ['true', 'false'])->nullable();
            $table->text('portal_ucc_1_override_a')->nullable();
            $table->text('portal_ucc_1_override_b')->nullable();
            $table->text('portal_ucc_1_override_c')->nullable();
            $table->enum('company_offset_refund_checks', ['false', 'true'])->nullable();
            $table->longText('tags')->nullable();
            $table->integer('sale_owner')->nullable();
            $table->integer('sale_status')->nullable();
            $table->string('sale_color')->nullable();
            $table->tinyInteger('tier')->nullable();
            $table->enum('company_ucc_monitoring', ['false', 'true'])->nullable();
            $table->text('location_name')->nullable();
            $table->integer('account_manager_id')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
