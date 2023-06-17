<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CursosContenido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos_contenidos', function (Blueprint $table) {
            $table->id();
            $table->string("titulo");
            $table->string("subtitulo")->nullable();
            $table->text("detalle")->nullable();
            $table->string("slug")->nullable();
            $table->string("contenido_download")->nullable();
            $table->string("img_fondo")->nullable();
            $table->string("img_contenido")->nullable();
            $table->text("recurso")->nullable();

            $table->unsignedBigInteger('cursos_contenido_tipo_id');
            $table->foreign('cursos_contenido_tipo_id')->references('id')->on('cursos_contenido_tipo')->onDelete('cascade');

            $table->unsignedBigInteger('cursos_id');
            $table->foreign('cursos_id')->references('id')->on('cursos')->onDelete('cascade');

            $table->unsignedBigInteger('cursos_modulo_id');
            $table->foreign('cursos_modulo_id')->references('id')->on('cursos_modulos')->onDelete('cascade');

            $table->unsignedBigInteger('cursos_clase_id');
            $table->foreign('cursos_clase_id')->references('id')->on('cursos_clases')->onDelete('cascade');

            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('cursos_contenido');
    }
}
