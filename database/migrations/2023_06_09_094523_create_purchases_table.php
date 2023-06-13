<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->biginteger('matter_id');
            $table->biginteger('reception_id1');
            $table->biginteger('reception_id2');
            $table->biginteger('reception_id3');
            $table->boolean('reception_flag1')->nullable();
            $table->boolean('reception_flag2')->nullable();
            $table->boolean('reception_flag3')->nullable();
            $table->string('goods_name1')->nullable();
            $table->string('goods_name2')->nullable();
            $table->string('goods_name3')->nullable();
            $table->string('goods_info1')->nullable();
            $table->string('goods_info2')->nullable();
            $table->string('goods_info3')->nullable();
            $table->string('goods_url1')->nullable();
            $table->string('goods_url2')->nullable();
            $table->string('goods_url3')->nullable();
            $table->integer('goods_opt1')->default(0)->nullable();
            $table->integer('goods_opt2')->default(0)->nullable();
            $table->integer('goods_opt3')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
