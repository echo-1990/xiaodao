<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUninsectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uninsects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('dog_id');
            $table->integer('medicine_id');
            $table->string('medicinename');
            $table->tinyInteger('number');
            $table->tinyInteger('type');
            $table->integer('admin_id');
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
        Schema::dropIfExists('uninsects');
    }
}
