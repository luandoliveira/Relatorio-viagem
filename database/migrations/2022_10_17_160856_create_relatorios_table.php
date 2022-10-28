<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelatoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relatorios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('tipo_demanda')->nullable();
            $table->string('demanda')->nullable();
            $table->string('objetivo')->nullable();
            $table->string('relatorio')->nullable();
            $table->string('observacao')->nullable();
            $table->date('ida')->nullable();
            $table->date('volta')->nullable();
            $table->bigInteger('sigeam')->nullable();
            $table->string('escola')->nullable();
            $table->string('municipio')->nullable();
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
        Schema::dropIfExists('relatorios');
    }
}
