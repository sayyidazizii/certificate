<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if(!Schema::hasTable('system_user_group')) {
            Schema::create('system_user_group', function (Blueprint $table) {
                $table->id('user_group_id');
                $table->integer('user_group_level')->nullable();
                $table->string('user_group_name')->nullable();
                $table->boolean('user_group_status')->nullable();
                $table->unsignedBigInteger('created_id')->nullable();
                $table->unsignedBigInteger('updated_id')->nullable();
                $table->unsignedBigInteger('deleted_id')->nullable();
                $table->timestamps();
                $table->softDeletesTz();
            });
             // Insert admin user
            DB::table('system_user_group')->insert(array(
                'user_group_level' => 1,
                'user_group_name' => "Administrator",
                'user_group_status' => 1
            ));
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('system_user_group');
    }
};
