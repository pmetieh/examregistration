<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMomoResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('momo_responses', function (Blueprint $table) {
            $table->id();
            $table->string('amount');
            $table->string('currency');
            $table->string('payeeNote');
            $table->string('referenceNo');
            $table->string('financialTransactionId');
            $table->string('phoneNo');
            $table->string('status');
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
        Schema::dropIfExists('momo_responses');
    }
}
