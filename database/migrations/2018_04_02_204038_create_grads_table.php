<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('uniLoc');
            $table->string('degreeEarned');
            $table->string('medicalSchool');
            $table->string('numAttempts');
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
        Schema::dropIfExists('grads');
    }
}
