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
        DB::insert('INSERT INTO users (name,name2,employee,email,password,approval,worktype_id)VALUES
("遠藤陽介","遠藤",101,"tenkabutu100@gmail.com","$2y$10$ZsfBX7D7o61Xz3BUgrUxUOR0YuSfZdqOdswXpe3A2bhsgteUMzGd6",0,1),
("一藤 恵","一藤",102,"g_ichifuji@ict-ss.com","$2y$10$pRDzBruCmfVtXCk2T3CC3e5I3EdGwYUVL7sc1BYvNcZhVwcp8BdQ2",0,1),
("松金 秀治","松金",103,"g_matsukane@ict-ss.com","$2y$10$dIdhF.NitoS5rLIP4zztGOk.YSmI7.e6C7IaoCDeKW/ANjuZwE56W",0,1),
("林田　菜緒","林田(菜)",104,"g_n-hayashida@ict-ss.com","$2y$10$eCcLQjz8xg/vaKedFHLnre.paxBTycaJQVMpN80mC7bb3CV2ullJ",0,2),
("加藤　丈典","加藤",100,"g_kato@ict-ss.com","$2y$10$KJBK7430Z3iTDr6oQbK0kuotM.aeSIoKINgn.a0A6MLYs0oaaWW9K",0,3)');
        //
    }
}
