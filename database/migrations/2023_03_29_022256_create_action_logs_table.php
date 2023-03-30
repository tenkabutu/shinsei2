<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('controller')->nullable()->comment('対象機能');
            $table->string('action')->comment('操作内容');
            $table->bigInteger('creater')->nullable()->comment('持ち主');
            $table->bigInteger('operator')->comment('操作者');
            $table->bigInteger('matter_id')->nullable()->comment('案件ID');
            $table->integer('matter_type')->nullable()->comment('案件種類');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_logs');
    }
}
