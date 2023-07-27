<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEditorTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('editor_tareas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('grupotarea_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->boolean('estado');
            $table->timestamps();
            $table->foreign('grupotarea_id')->references('id')->on('grupo_tareas');
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
        Schema::dropIfExists('editor_tareas');
    }
}
