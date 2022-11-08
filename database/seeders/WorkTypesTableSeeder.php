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
        DB::insert("INSERT INTO `worktypes` ( `worktype`, `def_hour1`, `def_hour2`, `def_minutes1`,`def_minutes2`,
 `def_breaktime`,`def_allotted`) VALUES
('9時-18時', 9,18,0,0,60,480),
('8時半-17時',8,17,30,0,60,450),
('9時-17時',9,17,0,0,60,420),
('10時-18時',10,18,0,0,60,420),
('8時半-16時半',8,16,30,30,60,420)");
}
}
