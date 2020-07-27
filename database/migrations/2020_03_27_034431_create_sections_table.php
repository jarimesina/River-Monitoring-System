<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('width',15,8);
            $table->double('y1',15,8);
            $table->double('y2',15,8)->nullable();
            $table->integer('shape');
            $table->double('multiplier',15,8);
            $table->unsignedBigInteger('river_id');
            $table->foreign('river_id')->references('id')->on('rivers')->onDelete('cascade');
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
        Schema::dropIfExists('sections');
    }
}
