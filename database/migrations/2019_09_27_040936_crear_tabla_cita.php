<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaCita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cita', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('cita_usu_id');
            $table->foreign('cita_usu_id','fk_cita_usuario')->references('id')->on('usuario')->
            onDelete('restrict')->onUpdate('restrict');
            $table->date('cita_fecha');
            $table->string('cita_hora');
            $table->string('cita_estado');
            $table->dateTime('cita_recibido')->nullable();
            $table->timestamps();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cita');
    }
}
