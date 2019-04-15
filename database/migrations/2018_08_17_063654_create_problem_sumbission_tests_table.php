<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemSumbissionTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problem_sumbission_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('status');
            $table->text('msg');
            $table->unsignedInteger('submission_id');
            $table->foreign('submission_id')->references('id')->on('problem_sumbissions');
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
        Schema::dropIfExists('problem_sumbission_tests');
    }
}
