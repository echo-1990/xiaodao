<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * weights体重记录表
    id
    dog_id
    weight
    create_at
    update_at
     */
    public function up()
    {
        Schema::create('weights', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('dog_id');
            $table->integer('weight');
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
        Schema::dropIfExists('weights');
    }
}
