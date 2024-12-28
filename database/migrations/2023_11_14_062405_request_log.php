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
        if(!Schema::hasTable('request_log')) {
            Schema::create('request_log', function (Blueprint $table) {
                $table->id('id');
                $table->string('method',10)->nullable();
                $table->text('uri')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->ipAddress('ip')->nullable();
                $table->text('header')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('request_log');
    }
};
