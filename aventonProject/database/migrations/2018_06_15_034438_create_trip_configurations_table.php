<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('origin');
            $table->string('destination');
            $table->integer('duration');
            $table->integer('cost');
            $table->time('startTime');
            $table->date('startDate');
            $table->date('endDate')->nullable();
            $table->enum('periodicity', ['Unica','Diaria','Semanal','Mensual']);
            $table->timestamps();
            $table->unsignedInteger('vehicle_id');
            $table->foreign('vehicle_id')
            ->references('id')->on('vehicle')
            ->onDelete('cascade');
            $table->unsignedInteger('custom_user_id');
            $table->foreign('custom_user_id')
            ->references('id')->on('customusers')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_configurations');
    }
}
