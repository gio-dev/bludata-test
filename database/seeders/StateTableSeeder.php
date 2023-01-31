<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pathStates = base_path() . '/database/seeders/estado.sql';
        $sqlStates = file_get_contents($pathStates);
        DB::unprepared($sqlStates);
    }
}
