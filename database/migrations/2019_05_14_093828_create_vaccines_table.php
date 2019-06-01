<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVaccinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * 疫苗表
     * id
     * dog_id
     * 用药类型id
     * 疫苗名
     * 条形码
     * 时间
     * 操作人
    create_at
    update_at
     */
    public function up()
    {
        Schema::create('vaccines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('dog_id');
            $table->integer('medicine_id');
            $table->string('medicinename');
            $table->bigInteger('pcode');
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
        Schema::dropIfExists('vaccines');
    }
}
