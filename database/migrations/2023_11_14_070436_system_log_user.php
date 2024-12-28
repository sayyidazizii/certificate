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
        if(!Schema::hasTable('system_log_user')) {
            Schema::create('system_log_user', function (Blueprint $table) {
                $table->id('user_log_id');
                $table->unsignedBigInteger('user_id')->nullable();
                $table->foreign('user_id')->references('user_id')->on('system_user')->onUpdate('cascade')->onDelete('set null');
                $table->string('username',50)->nullable();
                $table->integer('id_previllage')->nullable();
                $table->boolean('log_stat')->nullable();
                $table->string('pk',50)->nullable();
                $table->string('remark',100)->nullable();
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
        Schema::drop('system_log_user');
    }
};
