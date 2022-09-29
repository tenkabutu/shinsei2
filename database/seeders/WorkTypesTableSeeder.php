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
        DB::insert("INSERT INTO `work_types` (`id`, `created_at`, `updated_at`, `worktype`, `setdate1`, `setdate2`, `hours`, `break`) VALUES
(1, NULL, NULL, '9時-18時:8', '09:00:00', '18:00:00', 8, 60),
(2, NULL, NULL, '8時半-17時:7.5', '08:30:00', '17:00:00', 7.5, 60),
(3, NULL, NULL, '9時-17時:7', '09:00:00', '17:00:00', 7, 60),
(4, NULL, NULL, '10時-18時:7', '10:00:00', '18:00:00', 7, 60),
(5, NULL, NULL, '8時半-16時半:7', '08:30:00', '16:30:00', 7, 60)");
}
}
