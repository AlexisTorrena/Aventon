<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('question');
            $table->string('answer')->nullable();
            $table->unsignedInteger('custom_user_id');
            $table->foreign('custom_user_id')
            ->references('id')->on('customusers');
            $table->unsignedInteger('trip_id');
            $table->foreign('trip_id')
            ->references('id')->on('trips')
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
        Schema::dropIfExists('questions');
    }
}
