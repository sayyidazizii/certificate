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
        if(!Schema::hasTable('preference_company')) {
            Schema::create('preference_company', function (Blueprint $table) {
                $table->id('company_id');
                $table->unsignedBigInteger('account_income_tax_id')->nullable();
                $table->string('company_name',50)->nullable();
                $table->text('company_address')->nullable();
                $table->text('logo')->nullable();
                $table->text('logo_icon')->nullable();
                $table->text('logo_icon_gray')->nullable();
                $table->timestamps();
                $table->softDeletesTz();
            });
             // Insert data
            DB::table('preference_company')->insert(array(
                'company_name' => "Ciptasolutindo",
                'company_address' => "Jl. Raya Solo-Tawangmangu No.Km 8,2, Tegal, Triyagan, Kec. Mojolaban, Kabupaten Sukoharjo, Jawa Tengah 57554",
                'logo' => "logo/logo-180x180.png",
                'logo_icon' => "logo/logo-180x180.png",
                'logo_icon_gray' => "logo/logo-180x180.png",
            ));
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('preference_company');
    }
};
