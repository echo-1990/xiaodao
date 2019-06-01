<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreeddogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *种犬信息表
     */
    public function up()
    {
        Schema::create('breeddogs', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('name');
            $table->string('certificate_id')->unique()->nullable($value = false);
            $table->dateTime('birth_at');
            $table->dateTime('introduction_at');
            $table->tinyInteger('sex');
            $table->string('province');
            $table->string('city');
            $table->string('area');
            $table->tinyInteger('varieties');
            $table->string('color');
            $table->tinyInteger('level');
            $table->string('defect');
            $table->text('content');
            $table->string('familytree')->nullable();
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
        Schema::dropIfExists('breeddogs');
    }
}
