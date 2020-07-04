<?php

use App\Allocation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAllocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('foodbank_id');
            $table->foreignId('user_id');
            $table->string('status',20)->default(Allocation::START);
            $table->integer('budget')->default(0);
            $table->integer('total')->default(0);
            $table->timestamps();
        });

        DB::statement("ALTER TABLE allocations AUTO_INCREMENT = 900000;");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('allocations');
    }
}
