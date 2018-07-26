<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('value');
            $table->string('comment');
            $table->unsignedInteger('owner_id');
            $table->foreign('owner_id')
            ->references('id')->on('customusers')
            ->onDelete('cascade');
            $table->unsignedInteger('qualifier_id');
            $table->foreign('qualifier_id')
            ->references('id')->on('customusers')
            ->onDelete('cascade');
            $table->unsignedInteger('trip_id');
            $table->foreign('trip_id')
            ->references('id')->on('trips')
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
        Schema::dropIfExists('scores');
    }
}
