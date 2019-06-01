<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('goodsname');
            $table->text('content');
            $table->integer('dog_id');
            $table->integer('price')->index();
            $table->tinyInteger('goods_type')->index();
            $table->tinyInteger('type')->index();
            $table->string('goodspic');
            $table->dateTime('birth_at');
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
        Schema::dropIfExists('goods');
    }
}
