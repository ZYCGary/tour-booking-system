<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * “Status” in “Booking” can only be one of these three values: 0: “Submitted”; 1: “Confirmed”; 2: “Cancelled”.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tour_id');
            $table->date('tour_date');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

//            $table->unique(['tour_id', 'tour_date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
