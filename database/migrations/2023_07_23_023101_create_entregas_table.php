<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntregasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entregas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_entrega')->nullable();
            $table->decimal('nota')->nullable();
            $table->string('comentarios')->nullable();
            $table->string('archivo')->nullable();
            $table->text('respuesta_foro')->nullable();
            $table->bigInteger('subtarea_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('subtarea_id')->references('id')->on('sub_tareas');
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
        Schema::dropIfExists('entregas');
    }
}
