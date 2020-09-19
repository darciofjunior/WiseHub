<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVagasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vagas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('habilidade_id')->unsigned();
            $table->foreignId('local_id')->unsigned();
            $table->enum('tipo_contratacao', ['PJ', 'CLT', 'Temporário', 'Estagiário']);
            $table->double('budget', 8, 2);
            $table->date('data_cadastro');
            $table->enum('contatado_por', ['Email', 'Telefone', 'Sem Contato'])->nullable();
            $table->enum('interessado', ['SIM', 'NÃO'])->nullable();
            $table->date('data_contato')->nullable();

            $table->foreign('habilidade_id')->references('id')->on('habilidades');
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
        Schema::dropIfExists('vagas');
    }
}
