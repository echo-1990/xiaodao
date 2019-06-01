<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     */
    public function up()
    {
        Schema::create('dogs', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->bigInteger('dog_id');
            $table->integer('mother_id');
            $table->integer('father_id');
            $table->integer('reproduction_id');
            $table->dateTime('birth_at');
            $table->tinyInteger('birth_order');
            $table->tinyInteger('sex');
            $table->string('province');
            $table->string('city');
            $table->string('area');
            $table->tinyInteger('dog_type');
            $table->string('color');
            $table->tinyInteger('level');
            $table->string('paper_id')->unique()->nullable();
            $table->string('chip_id')->unique()->nullable();
            $table->string('certificate_id')->unique()->nullable();
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
        Schema::dropIfExists('dogs');
    }
}
