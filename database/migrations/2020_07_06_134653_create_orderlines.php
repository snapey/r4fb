<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderlines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderlines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->string('code',30);
            $table->string('description',100);
            $table->string('uom',10)->nullable();
            $table->string('sku',30)->nullable();
            $table->integer('qty');
            $table->integer('each');
            $table->integer('total');
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
        Schema::dropIfExists('orderlines');
    }
}
