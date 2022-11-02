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
            $table->integer('task_hour1');
            $table->integer('task_hour2');
            $table->integer('task_minutes1');
            $table->integer('task_minutes2');
            $table->integer('task_breaktime')->nullable();
            $table->integer('task_allotted');
            $table->integer('task_status');
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
