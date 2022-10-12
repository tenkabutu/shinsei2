<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("INSERT INTO `worktypes` (`id`, `created_at`, `updated_at`, `worktype`, `setdate1`, `setdate2`, `hours`,`minutes`, `break`) VALUES
(1, NULL, NULL, '9時-18時', '09:00:00', '18:00:00', 8,0, 60),
(2, NULL, NULL, '8時半-17時', '08:30:00', '17:00:00', 7,30, 60),
(3, NULL, NULL, '9時-17時', '09:00:00', '17:00:00', 7,0, 60),
(4, NULL, NULL, '10時-18時', '10:00:00', '18:00:00', 7,0, 60),
(5, NULL, NULL, '8時半-16時半', '08:30:00', '16:30:00', 7,0, 60)");
}
}
