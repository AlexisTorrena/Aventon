<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', ['Abierto','Cerrado','Cancelado','Realizado']);
            $table->string('origin');
            $table->string('destination');
            $table->dateTime('date');
            $table->integer('cost');
            $table->enum('periodicity', ['Unica','Diaria','Semanal','Mensual']);
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
        Schema::dropIfExists('trips');
    }
}
