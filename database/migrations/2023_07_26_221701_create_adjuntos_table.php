<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdjuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->bigInteger('subtarea_id')->unsigned();
            $table->string('archivo')->nullable();
            $table->text('texto')->nullable();
            $table->timestamps();

            $table->foreign('subtarea_id')->references('id')->on('sub_tareas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adjuntos');
    }
}
