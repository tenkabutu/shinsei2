<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NametagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO nametags (nametag,groupid,revision)VALUES
("管理者",1,1),
("リーダー",1,1),
("支援員",1,1),
("江越",2,1),
("八代",2,1),
("山鹿",2,1),
("すべて",3,1),
("エリア",3,1)
'
);
    }
}
