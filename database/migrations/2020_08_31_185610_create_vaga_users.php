<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVagaUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaga_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vaga_id')->unsigned();
            $table->foreignId('user_id')->unsigned();

            $table->foreign('vaga_id')->references('id')->on('vagas');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vaga_users');
    }
}
