<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBioDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bio_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fName');
            $table->string('surName');
            $table->string('oName');
            $table->string('examno');
            $table->string('gender');
            $table->date('dateOfBirth');
            $table->string('maritalStatus');
            $table->string('country');
            $table->string('highSchool');
            $table->string('yearGraduated');
            $table->string('schoolType');
            $table->string('schoolLocation');
            $table->string('major');
            $table->string('numAttempts');
            $table->string('eduLevel');
            $table->string('phoneNo');
            $table->string('email');
            //$table->string('phoneNo');
            $table->string('emrgPhone1');
            $table->string('emrgPhone2');
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
        Schema::dropIfExists('bio_datas');
    }
}
