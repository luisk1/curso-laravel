<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaCitaxorden extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citaxorden', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('citax_id');
            $table->foreign('citax_id','fk_citaxorden_cita')->references('id')->on('cita')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedInteger('citaorden');
            $table->foreign('citaorden','fk_citaxorden_orden')->references('orden')->on('ordencompra')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('citaxorden');
    }
}
