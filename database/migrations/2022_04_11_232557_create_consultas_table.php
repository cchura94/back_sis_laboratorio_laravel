<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            // paciente_id
            $table->bigInteger("paciente_id")->unsigned();
            $table->foreign("paciente_id")->references("id")->on("personas");
            // profesional_id
            $table->bigInteger("profesional_id")->unsigned();
            $table->foreign("profesional_id")->references("id")->on("personas");
            // sucural_id
            $table->bigInteger("sucursal_id")->unsigned();
            $table->foreign("sucursal_id")->references("id")->on("sucursals");
            // fecha
            $table->dateTime("fecha_consulta");
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
        Schema::dropIfExists('consultas');
    }
}
