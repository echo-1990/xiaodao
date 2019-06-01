<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReproductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * 繁殖计划表
     *
     */
    public function up()
    {
        Schema::create('reproductions', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('mother_id');
            $table->integer('father_id');
            $table->tinyInteger('result');
            $table->dateTime('production_at');
            $table->tinyInteger('yields');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reproductions');
    }
}
