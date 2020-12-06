<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passengers', function (Blueprint $table) {
            $table->id();
            $table->string('given_name', 128);
            $table->string('surname', 64);
            $table->string('email', 128);
            $table->string('mobile', 16);
            $table->string('passport', 16);
            $table->date('birth_date');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->unique(['email', 'passport']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('passengers');
    }
}
