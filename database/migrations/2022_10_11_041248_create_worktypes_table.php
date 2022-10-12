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
            $table->Time('setdate1')->nullable();
            $table->Time('setdate2')->nullable();
            $table->integer('hours')->default(0)->nullable();
            $table->integer('minutes')->default(0)->nullable();
            $table->integer('break')->default(60)->nullable();
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
