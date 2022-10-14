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
            $table->Time('starttime');
            $table->Time('endtime');
            $table->string('order_content');
            $table->string('work_content')->nullable();
            $table->integer('status')->default(1)->nullable();


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
