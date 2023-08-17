<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('user_fname')->nullable();
            $table->string('user_lname')->nullable();
            $table->string('user_roles')->nullable();
            $table->string('user_create_user_id')->nullable();
            $table->string('user_delete_user_id')->nullable();
            $table->string('user_approved_alert')->nullable();
            $table->string('user_assigned_alert')->nullable();
            $table->string('user_work_order_alert')->nullable();
            $table->string('user_accountant')->nullable();
            $table->string('user_away')->nullable();
            $table->string('user_signature_message')->nullable();
            $table->string('user_signature_image')->nullable();
            $table->string('user_status')->nullable();
            $table->string('user_salary')->nullable();
            $table->string('user_hire_date')->nullable();
            $table->string('pto_rate_id')->nullable();
            $table->string('user_print_sos_checks')->nullable();
            $table->string('user_reports_access')->nullable();
            $table->string('user_hamburger_menu')->nullable();
            $table->string('user_access_ip')->nullable();
            $table->string('user_out_of_office')->nullable();
            $table->string('user_developer')->nullable();
            $table->string('user_global_search')->nullable();
            $table->string('user_out_of_office_forward_user_id')->nullable();
            $table->string('user_out_of_office_message')->nullable();
            $table->enum('user_sales', ['true', 'false'])->nullable();
            $table->enum('user_delete', ['true', 'false'])->nullable();
            $table->string('user_title')->nullable();
            $table->string('user_address_1')->nullable();
            $table->string('user_address_2')->nullable();
            $table->string('user_array')->nullable();
            $table->string('user_tire_zone')->nullable();
            $table->text('profile_photo_path')->nullable();
            $table->date('user_delete_time')->nullable();
            $table->string('user_time_zone')->nullable();
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
        Schema::dropIfExists('users');
    }
}
