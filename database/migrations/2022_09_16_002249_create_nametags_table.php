<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNametagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nametags', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nametag');
            $table->integer('tagid');
            $table->integer('groupid')->default(0);
            $table->integer('revision')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nametags');
    }
}
