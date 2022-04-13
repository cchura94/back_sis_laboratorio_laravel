<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConsultaTipoexamen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consulta_tipoexamen', function (Blueprint $table) {
            $table->primary(["consulta_id", "tipoexamen_id"]);

            $table->string("archvivo")->nullable();
            $table->text("detalle")->nullable();

            $table->bigInteger("consulta_id")->unsigned();
            $table->bigInteger("tipoexamen_id")->unsigned();
            $table->foreign("consulta_id")->references("id")->on("consultas");
            $table->foreign("tipoexamen_id")->references("id")->on("tipoexamens");

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
        Schema::dropIfExists('consulta_tipoexamen');
    }
}
