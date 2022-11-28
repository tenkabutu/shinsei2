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
("管理者",1,1,1),
("リーダー",2,1,1),
("支援員",3,1,1),
("すべて",1,2,1),
("エリア",2,2,1),
("なし",0,2,1),
("江越",0,3,1),
("八代",1,3,1),
("山鹿",2,3,1),
("振替",1,4,1),
("休暇",2,4,1),
("テレワ",3,4,1),
("未申請",1,5,1),
("申請中",2,5,1),
("許可済",3,5,1),
("却下",4,5,1),
("再提出",5,5,1)'
);
    }
}
