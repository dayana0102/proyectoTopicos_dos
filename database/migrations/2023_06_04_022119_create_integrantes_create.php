<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntegrantesCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integrantes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('panel_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->integer('rol'); //1 dueño //2 invitado;
            $table->timestamps();

            $table->foreign('panel_id')->references('id')->on('panels');
            $table->foreign('user_id')->references('id')->on('users');
           // $table->foreign('rol_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('integrantes_create');
    }
}
