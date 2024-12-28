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
        if(!Schema::hasTable('system_menu')) {
            Schema::create('system_menu', function (Blueprint $table) {
                $table->string('id_menu',10);
                $table->primary('id_menu');
                $table->string('id',100)->nullable();
                $table->enum('type',['folder','file','function'])->nullable();
                $table->string('text',50)->nullable();
                $table->string('parent_id',50)->nullable();
                $table->string('image',50)->nullable();
                $table->string('menu_level',50)->nullable();
                $table->softDeletesTz();
            });
            DB::table('system_menu')->insert([
               [ 'id_menu' => 1,  'id' => 'dashboard',          'type' => 'file', 'text'  => 'Dashboard','parent_id' => "#",'menu_level' => "1",],
               [ 'id_menu' => 10, 'id' => '#',                  'type' => 'file',   'text' => 'Barang','parent_id' => "8",'menu_level' => "2",],
               [ 'id_menu' => 86, 'id' => 'participant',        'type' => 'file', 'text'  => 'Peserta','parent_id' => "10",'menu_level' => "2",],
               [ 'id_menu' => 87,'id'=>  'winner',             'type' => 'file', 'text'  => 'Juara','parent_id' => "10",'menu_level' => "2",],
               [ 'id_menu' => 88, 'id' => 'dojo',               'type' => 'file',   'text' => 'Dojo','parent_id' => "10",'menu_level' => "2",],
               [ 'id_menu' => 2,  'id' => '#',                  'type' => 'file', 'text'  => 'Sertifikat','parent_id' => "#",'menu_level' => "1",],
               [ 'id_menu' => 21, 'id' => 'certificate',        'type' => 'file', 'text'  => 'cetak','parent_id' => "2",'menu_level' => "1",],
               [ 'id_menu' => 8,  'id' => '#',                  'type' => 'folder', 'text'=> 'Preferensi','parent_id' => "#",'menu_level' => "1",],
               [ 'id_menu' => 81, 'id' => 'preference-company', 'type' => 'file', 'text'  => 'Perusahaan','parent_id' => "8",'menu_level' => "2",],
               [ 'id_menu' => 82, 'id' => 'user',               'type' => 'file', 'text'  => 'Pengaturan User','parent_id' => "8",'menu_level' => "2",],
               [ 'id_menu' => 83,'id' => 'menu',               'type' => 'file', 'text'  => 'Pengaturan Menu','parent_id' => "8",'menu_level' => "2",],
               [ 'id_menu' => 84, 'id' => 'user-group',         'type' => 'file', 'text'  => 'Pengaturan User Group','parent_id' => "8",'menu_level' => "2",],
               [ 'id_menu' => 85, 'id' => 'CoreBranch',         'type' => 'file', 'text'  => 'kode cabang','parent_id' => "8",'menu_level' => "2",],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('system_menu');
    }
};
