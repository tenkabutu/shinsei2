<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->biginteger('matter_id');
            $table->dateTime('task_request_date')->nullable();
            $table->dateTime('task_reply_date')->nullable();
            $table->dateTime('task_change_date');
            $table->Time('task_starttime');
            $table->Time('task_endtime');
            $table->integer('task_breaktime');
            $table->integer('task_allotted');
            $table->integer('task_status')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
