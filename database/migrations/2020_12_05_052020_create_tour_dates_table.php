<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_dates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tour_id');
            $table->date('date');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->unique(['tour_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tour_dates');
    }
}
