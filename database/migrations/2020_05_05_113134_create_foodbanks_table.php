<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodbanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foodbanks', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('charity', 10)->nullable();
            $table->string('organisation', 100)->nullable();
            $table->string('location',100)->nullable();
            $table->string('email',100)->nullable();
            $table->string('website',100)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('foodbanks');
    }
}
