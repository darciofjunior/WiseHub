<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('local_id')->unsigned();
            $table->string('nome', 50);
            $table->string('email', 80)->unique();
            $table->string('telefone', 20);
            $table->string('password')->nullable();
            $table->enum('experiencia', ['0', '1', '3', '5', '7']);
            $table->enum('tipo_contratacao', ['PJ', 'CLT', 'Temporário', 'Estagiário']);
            $table->date('data_cadastro');
            $table->foreign('local_id')->references('id')->on('locals');
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
