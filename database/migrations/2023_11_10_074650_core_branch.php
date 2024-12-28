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
        if(!Schema::hasTable('core_branch')) {
            Schema::create('core_branch', function (Blueprint $table) {
                $table->id('branch_id');
                $table->unsignedBigInteger('company_id')->nullable();
                $table->foreign('company_id')->references('company_id')->on('preference_company')->onUpdate('cascade')->onDelete('set null');
                $table->string('branch_code',50)->nullable();
                $table->string('branch_name')->nullable();
                $table->string('branch_manager',50)->nullable();
                $table->text('branch_address')->nullable();
                $table->string('branch_city',50)->nullable();
                $table->string('branch_contact_person',50)->nullable();
                $table->string('branch_email',50)->nullable();
                $table->string('branch_phone1',30)->nullable();
                $table->string('branch_phone2',30)->nullable();
                $table->integer('account_rak_id')->nullable()->default(0);
                $table->integer('account_aka_id')->nullable()->default(0);
                $table->integer('account_capital_id')->nullable()->default(0);
                $table->integer('branch_has_child')->nullable()->default(0);
                $table->integer('branch_top_parent_id')->nullable()->default(0);
                $table->integer('branch_parent_id')->nullable()->default(0);
                $table->boolean('branch_status')->nullable()->default(0);                
                $table->unsignedBigInteger('created_id')->nullable();
                $table->unsignedBigInteger('updated_id')->nullable();
                $table->unsignedBigInteger('deleted_id')->nullable();
                $table->timestamps();
                $table->softDeletesTz();
            });
            // Insert admin user
            DB::table('core_branch')->insert(array(
                'branch_code' => '003',
                'branch_name' => "CV 1",
                'branch_address' => "Jl. Raya Solo-Tawangmangu No.Km 8,2, Tegal, Triyagan, Kec. Mojolaban, Kabupaten Sukoharjo, Jawa Tengah 57554",
                'branch_city' => 'Karanganyar',
            ));
            DB::table('core_branch')->insert(array(
                'branch_code' => '002',
                'branch_name' => "CV 2",
                'branch_address' => "Jl. Raya Solo-Tawangmangu No.Km 8,2, Tegal, Triyagan, Kec. Mojolaban, Kabupaten Sukoharjo, Jawa Tengah 57554",
                'branch_city' => 'Karanganyar',
            ));
            DB::table('core_branch')->insert(array(
                'branch_code' => '003',
                'branch_name' => "CV 3",
                'branch_address' => "Jl. Raya Solo-Tawangmangu No.Km 8,2, Tegal, Triyagan, Kec. Mojolaban, Kabupaten Sukoharjo, Jawa Tengah 57554",
                'branch_city' => 'Karanganyar',
            ));
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
