<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibrosUsuariosEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros_usuarios_estados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fecha_prestamo');
            $table->string('fecha_devolucion');
            $table->integer('libro_id')->unsigned();
            $table->integer('usuario_id')->unsigned();
            $table->integer('estado_id')->unsigned();

            $table->foreign('libro_id')->references('id')->on('libros');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->foreign('estado_id')->references('id')->on('estados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libros_usuarios_estados');
    }
}
