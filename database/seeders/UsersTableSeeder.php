<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO users (name,name2,employee,email,password,role,approval,worktype_id)VALUES
("水田　浩子","水田",5,"ss_mizuta@ict-ss.com","$2y$10$.BB5GYTstXc7hW29tY9z6eVgJZTuXIW9ICiVuJAdLOSwjTHJd0fG6",1,0,1),
("遠藤陽介","遠藤",101,"tenkabutu100@gmail.com","$2y$10$ZsfBX7D7o61Xz3BUgrUxUOR0YuSfZdqOdswXpe3A2bhsgteUMzGd6",1,0,1)');
        //
    }
}
