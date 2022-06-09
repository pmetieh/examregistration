<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnderGradsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('under_grads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('examNo');
            $table->string('schCategory');
            $table->string('eduLevel');
            $table->string('highSchool');
            $table->string('graduationYear');
            $table->date('locCounty');
            $table->string('locDistrict');
            $table->string('collegeChoice');
            $table->string('majorName');
            $table->string('numAttempts');
            $table->timestamps();


           /* $table->string('highSchool');
            $table->string('graduationYear');
            $table->string('eduLevel');
            $table->string('college');
            $table->string('major');
            $table->string('collegeChoice');
            $table->string('schCategory');*/
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('under_grads');
    }
}
