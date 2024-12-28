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
        if(!Schema::hasTable('user_infos')) {
            Schema::create('user_infos', function (Blueprint $table) {
                $table->id('id');
                $table->unsignedBigInteger('user_id')->nullable();
                $table->foreign('user_id')->references('user_id')->on('system_user')->onUpdate('cascade')->onDelete('set null');
                $table->text('avatar')->nullable();
                $table->string('company')->nullable();
                $table->string('phone')->nullable();
                $table->string('website')->nullable();
                $table->string('country')->nullable();
                $table->string('language')->nullable();
                $table->string('timezone')->nullable();
                $table->string('currency')->nullable();
                $table->string('communication')->nullable();
                $table->string('marketing')->nullable();
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
        Schema::drop('user_infos');
    }
};
