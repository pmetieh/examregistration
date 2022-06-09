<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AssignTC extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //pivot table for the manay to many relationship between
        //testingcenter and user
         Schema::create('assigntc', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('testing_center_id');
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
        //
        Schema::dropIfExists('assigntc');
    }
}
