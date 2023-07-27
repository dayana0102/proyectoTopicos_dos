<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_tareas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('grupotarea_id')->unsigned();
            $table->string('nombre');
            $table->integer('tipo');//1: informativo - 2:archivo 
            $table->dateTime('fecha_limite')->nullable();
            $table->boolean('estado')->default(0); //activo - descativo
            $table->timestamps();
            $table->foreign('grupotarea_id')->references('id')->on('grupo_tareas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_tareas');
    }
}
