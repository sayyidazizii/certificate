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
        //
        // Schema::create("activity_log", function (Blueprint $table) {
        //     $table->id("id");
        //     $table->string('log_name')->nullable();
        //     $table->text('properties')->nullable();
        //     $table->integer('causer_id')->nullable();
        //     $table->string('causer_type')->nullable();
        //     $table->string('batch_uuid')->nullable();
        //     $table->string('event')->nullable();
        //     $table->integer('subject_id')->nullable();
        //     $table->string('subject_type')->nullable();
        //     $table->string('description')->nullable();
        //     $table->unsignedBigInteger('created_id')->nullable();
        //     $table->unsignedBigInteger('updated_id')->nullable();
        //     $table->unsignedBigInteger('deleted_id')->nullable();
        //     $table->softDeletesTz();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('activity_log');
    }
};
