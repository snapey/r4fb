<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->foreignId('supplier_id');
            $table->integer('cost')->default(0);
            $table->integer('shipping')->default(0);
            $table->string('shipto_type')->nullable();
            $table->string('shipto_id')->nullable();
            $table->date('deliver_date')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('user_id');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE orders AUTO_INCREMENT = 800000;");

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
