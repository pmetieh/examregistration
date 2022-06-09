<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        
        Schema::create('users', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('testing_center_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('firstName');
            $table->string('otherName');
            $table->string('lastName');
            $table->string('dob');
            $table->string('gender');
            $table->string('mobileNo');
            $table->string('emergencyNo1');
            $table->string('emergencyNo2');
            $table->string('maritalStatus');
            $table->string('countyOfO');
            $table->string('nationality');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
