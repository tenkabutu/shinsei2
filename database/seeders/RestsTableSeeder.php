<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO rests (user_id,rest_year,rest_allotted_day,co_day,co_time,co_harf_rest)VALUES
(101,2023,10,5,0,1)');
    }
}
