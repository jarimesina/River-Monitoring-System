<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaterLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('water_levels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('entry_id');
            $table->float('level', 8, 2);
            $table->string('velocity');
            $table->string('temperature');
            $table->string('date_taken');
            $table->unsignedBigInteger('river_id')
                  ->references('id')
                  ->on('rivers')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('water_levels');
    }
}
