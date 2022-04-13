<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string("nombres", 50);
            $table->string("apellidos", 50);
            $table->string("ci_dni", 15)->unique();
            $table->string("telefono", 15)->nullable();
            $table->date("fecha_nacimiento")->nullable();
            $table->string("direccion")->nullable();
            $table->string("ciudad")->nullable();
            $table->string("pais")->nullable();
            
            // relacion (1:1) entre persona y user
            $table->bigInteger("user_id")->unsigned()->nullable();
            $table->foreign("user_id")->references("id")->on("users");
            
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
        Schema::dropIfExists('personas');
    }
}
