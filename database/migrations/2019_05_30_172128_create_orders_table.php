<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id');
            $table->integer('price');
            $table->string('openid');
            $table->string('province');
            $table->string('city');
            $table->string('area');
            $table->string('addressinfo');
            $table->string('phone');
            $table->integer('dog_id');
            $table->integer('deliver_id');
            $table->tinyInteger('certificate_type');
            $table->tinyInteger('pay_type');
            $table->string('pay_id');
            $table->timestamp('pay_at');
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
        Schema::dropIfExists('orders');
    }
}
