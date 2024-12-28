<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DB::unprepared(file_get_contents('core-alamat-16112023.sql'));
        $this->call([
            CoreBranchSeeder::class,
        ]);
    }
}
