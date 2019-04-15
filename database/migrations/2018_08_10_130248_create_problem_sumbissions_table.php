<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemSumbissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problem_sumbissions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('source_code');
            $table->unsignedInteger('status');
            $table->unsignedInteger('max_mem');
            $table->float('max_time');
            $table->unsignedInteger('problem_id');
            $table->unsignedInteger('user_id');
            $table->foreign('problem_id')->references('id')->on('problems');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('problem_sumbissions');
    }
}
