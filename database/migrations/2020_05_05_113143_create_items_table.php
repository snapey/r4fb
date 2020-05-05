<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('code', 30);
            $table->string('sku', 30)->nullable();
            $table->string('uom', 10)->nullable();
            $table->integer('weight')->nullable();
            $table->string('description', 100)->nullable();
            $table->string('durability', 20)->nullable();
            $table->boolean('generic');
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
        Schema::dropIfExists('items');
    }
}
