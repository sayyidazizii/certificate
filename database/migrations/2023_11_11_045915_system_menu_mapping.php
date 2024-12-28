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
        if(!Schema::hasTable('system_menu_mapping')) {
            Schema::create('system_menu_mapping', function (Blueprint $table) {
                $table->id('menu_mapping_id');
                $table->integer('user_group_id')->nullable();
                $table->string('id_menu')->nullable();
                $table->foreign('id_menu')->references('id_menu')->on('system_menu')->onUpdate('cascade')->onDelete('cascade');
                $table->timestamps();
                $table->softDeletesTz();
            });
             // Insert admin user
            DB::table('system_menu_mapping')->insert([
                ['user_group_id' => 1,'id_menu' => 1  ],
                ['user_group_id' => 1,'id_menu' => 10 ],
                ['user_group_id' => 1,'id_menu' => 2  ],
                ['user_group_id' => 1,'id_menu' => 21  ],
                ['user_group_id' => 1,'id_menu' => 8 ],
                ['user_group_id' => 1,'id_menu' => 81 ],
                ['user_group_id' => 1,'id_menu' => 81 ],
                ['user_group_id' => 1,'id_menu' => 82 ],
                ['user_group_id' => 1,'id_menu' => 83 ],
                ['user_group_id' => 1,'id_menu' => 84 ],
                ['user_group_id' => 1,'id_menu' => 85 ],
                ['user_group_id' => 1,'id_menu' => 86 ],
                ['user_group_id' => 1,'id_menu' => 87 ],
                ['user_group_id' => 1,'id_menu' => 88 ],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('system_menu_mapping');
    }
};
