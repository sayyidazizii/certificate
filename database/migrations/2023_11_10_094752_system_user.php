<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if(!Schema::hasTable('system_user')) {
        Schema::create('system_user', function (Blueprint $table) {
            $table->id('user_id');
            $table->integer('user_level')->nullable();
            $table->unsignedBigInteger('user_group_id')->nullable();
            $table->foreign('user_group_id')->references('user_group_id')->on('system_user_group')->onUpdate('cascade')->onDelete('set null');
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')->references('branch_id')->on('core_branch')->onUpdate('cascade')->onDelete('set null');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('company_id')->on('preference_company')->onUpdate('cascade')->onDelete('set null');
            $table->string('username');
            $table->string('full_name')->nullable();
            $table->string('password');
            $table->dateTime('password_date')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->dateTime('email_verified_at')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->dateTime('verified_at')->nullable();
            $table->string('log_stat')->nullable();
            $table->boolean('branch_status')->default(0);
            $table->string('avatar')->nullable();
            $table->unsignedBigInteger('created_id')->nullable();
            $table->unsignedBigInteger('updated_id')->nullable();
            $table->unsignedBigInteger('deleted_id')->nullable();
            $table->timestamps();
            $table->softDeletesTz();
        });
         // Insert admin user
        DB::table('system_user')->insert(array(
                'username' => 'administrator',
                'user_level' => 1,
                'user_group_id' => 1,
                'branch_id' => 1,
                'company_id' => 1,
                'email' => 'admin@email.com',
                'password'=>Hash::make('ulala123'),
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
                'password_date'=> date('Y-m-d H:i:s')
        ));

         // Insert other user
         DB::table('system_user')->insert(array(
            'username' => 'anton',
            'user_level' => 1,
            'user_group_id' => 1,
            'branch_id' => 1,
            'company_id' => 1,
            'email' => 'anton@email.com',
            'password'=>Hash::make('4502'),
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s'),
            'password_date'=> date('Y-m-d H:i:s')
        ));

        // Insert other user
        DB::table('system_user')->insert(array(
            'username' => 'sayyid',
            'user_level' => 1,
            'user_group_id' => 1,
            'branch_id' => 1,
            'company_id' => 1,
            'email' => 'sayyid@email.com',
            'password'=>Hash::make('2234'),
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s'),
            'password_date'=> date('Y-m-d H:i:s')
        ));

        // Insert other user
        DB::table('system_user')->insert(array(
            'username' => 'lyani',
            'user_level' => 1,
            'user_group_id' => 1,
            'branch_id' => 1,
            'company_id' => 1,
            'email' => 'lyani@email.com',
            'password'=>Hash::make('123456'),
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s'),
            'password_date'=> date('Y-m-d H:i:s')
        ));
        }

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('system_user');
    }
};
