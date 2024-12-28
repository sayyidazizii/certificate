<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if(!Schema::hasTable('core_branch')) {
            Schema::create('core_branch', function (Blueprint $table) {
                $table->id('branch_id');
                $table->string('branch_code',50)->nullable();
                $table->string('branch_name')->nullable();
                $table->text('branch_address')->nullable();
                $table->string('branch_city')->nullable();
                $table->string('branch_contact_person')->nullable();
                $table->string('branch_email')->nullable();
                $table->string('branch_phone1')->nullable();
                $table->string('branch_phone2')->nullable();
                $table->string('branch_manager')->nullable();
                $table->integer('account_rak_id')->nullable();
                $table->integer('account_aka_id')->nullable();
                $table->integer('account_capital_id')->nullable();
                $table->integer('branch_top_parent_id')->nullable();
                $table->integer('branch_parent_id')->nullable();
                $table->boolean('branch_has_child')->nullable();
                $table->unsignedBigInteger('created_id')->nullable();
                $table->unsignedBigInteger('updated_id')->nullable();
                $table->unsignedBigInteger('deleted_id')->nullable();
                $table->timestamps();
                $table->softDeletesTz();
            });
             
            }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('core_branch');
    }
};
