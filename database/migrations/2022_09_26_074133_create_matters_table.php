<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMattersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matters', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('user_id');
            $table->integer('reception_id')->nullable();
            $table->integer('matter_type');
            $table->dateTime('matter_request_date')->nullable();
            $table->dateTime('matter_reply_date')->nullable();
            $table->dateTime('matter_change_date');
            //$table->Time('starttime');
            //$table->Time('endtime');
            $table->integer('hour1');
            $table->integer('hour2');
            $table->integer('minutes1');
            $table->integer('minutes2');
            $table->integer('breaktime');
            $table->integer('allotted');
            $table->integer('allotted2')->default(0)->nullable();
            $table->string('order_content');
            $table->string('work_content')->nullable();
            $table->integer('status')->default(1)->nullable();
            $table->integer('opt1')->default(0)->nullable();
            $table->integer('opt2')->default(0)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matters');
    }
}
