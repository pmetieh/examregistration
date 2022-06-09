<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestingCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testing_centers', function (Blueprint $table) {
            $table->increments('id');
           // $table->string('user_id');
            $table->string('centerName');
            $table->integer('capacity');
            $table->integer('noAssigned');
            $table->boolean('filled');
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
        Schema::dropIfExists('testing_centers');
    }


    
}
