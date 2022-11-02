<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorktypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worktypes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('worktype');
            //$table->Time('setdate1')->nullable();
            //$table->Time('setdate2')->nullable();
            $table->integer('def_hour1')->default(0)->nullable();
            $table->integer('def_minutes1')->default(0)->nullable();
            $table->integer('def_hour2')->default(0)->nullable();
            $table->integer('def_minutes2')->default(0)->nullable();
            $table->integer('def_breaktime')->default(60)->nullable();
            $table->integer('def_allotted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('worktypes');
    }
}
