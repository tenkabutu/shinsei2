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
        DB::insert('INSERT INTO nametags (nametag,tagid,groupid,revision)VALUES
("管理者",0,1,1),
("リーダー",1,1,1),
("支援員",2,1,1),
("すべて",1,2,1),
("エリア",2,2,1),
("なし",0,2,1),
("江越",0,3,1),
("八代",1,3,1),
("山鹿",2,3,1),
("振替",1,4,1),
("休暇",2,4,1),
("テレワ",3,4,1)
'
);
    }
}
