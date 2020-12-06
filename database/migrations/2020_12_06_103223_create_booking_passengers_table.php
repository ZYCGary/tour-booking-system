<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingPassengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_passengers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('passenger_id');
            $table->text('special_request');
            $table->timestamps();

            $table->unique(['booking_id', 'passenger_id']);

            $table->index(['booking_id', 'passenger_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_passengers', function (Blueprint $table) {
            $table->dropIndex(['booking_id', 'passenger_id']);

            $table->dropIfExists();
        });
    }
}
