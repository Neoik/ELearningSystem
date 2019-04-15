<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemIOTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problem_i_o_tests', function (Blueprint $table) {
          $table->increments('id');
          $table->text('input');
          $table->text('output');
          $table->unsignedInteger('problem_id');
          $table->foreign('problem_id')->references('id')->on('problems');
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
        Schema::dropIfExists('problem_i_o_tests');
    }
}
