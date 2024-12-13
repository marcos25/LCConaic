<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * tabla academicos
         */
        Schema::create('academicos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('privilegio')->default(false);
            // $table->integer('categoria_id')->unsigned()->nullable(); por el momento no lo necesita por que ya tiene la llave foranea la tabla categorias
            $table->rememberToken();
        });

        /**
         * Tabla categorias
         */
        Schema::create('categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->longText('descripcion');
            $table->integer('academico_id')->unsigned()->nullable();           
        });

        /**
         * Creo la llave foranea en la tabla categorias, primero se tiene que crear el tipo de atributo, para luego crear la llave foranea
         */
        Schema::table('categorias',function(Blueprint $table){
            $table->foreign('academico_id')->references('id')->on('academicos')->onDelete('cascade')->onUpdate('cascade');
        });

        /**
         * Tabla de recomendaciones
         */
        Schema::create('recomendaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->longText('descripcion');
            $table->integer('categoria_id')->unsigned();
            $table->integer('plan_accion')->unsigned()->nullable();
        });
        /**
         * Creo la llave foranea en la tabla recomendaciones, primero se tiene que crear el tipo de atributo, para luego crear la llave foranea
         */
        Schema::table('recomendaciones',function(Blueprint $table){
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade')->onUpdate('cascade');
        });
        
        /**
         * tabla planes de accion
         */
        Schema::create('planes_de_acciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->longText('descripcion');
            $table->integer('categoria_id')->unsigned()->nullable();
            $table->integer('recomendacion_id')->unsigned();
            $table->string('fecha_termino');
            $table->boolean('completado')->default(false);
            $table->longText('criterio')->nullable();
        });

        /**
         * Creo la llave foranea en la tabla planes_de_acciones, primero se tiene que crear el tipo de atributo, para luego crear la llave foranea
         */
        Schema::table('planes_de_acciones',function(Blueprint $table){
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('recomendacion_id')->references('id')->on('recomendaciones')->onDelete('cascade')->onUpdate('cascade');
        });

        /**
         * tabla evidencias
         */
        Schema::create('evidencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_archivo');
            $table->string('tipo_archivo');
            $table->string('archivo_bin');
        });

        /**
         * tabla pivote para relacionar la tabla planes de acciones con la de evidencias.
         */
        Schema::create('evidencias_planes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plan_accion_id')->nullable()->unsigned();
            $table->integer('evidencia_id')->nullable()->unsigned();
        });
        /**
         * Creo la llave foranea en la tabla pivote evidencias_planes, primero se tiene que crear el tipo de atributo, para luego crear la llave foranea
         */
        Schema::table('evidencias_planes',function(Blueprint $table){
            $table->foreign('plan_accion_id')->references('id')->on('planes_de_acciones')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('evidencia_id')->references('id')->on('evidencias')->onDelete('cascade')->onUpdate('cascade');
        });
        
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academicos');
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('planes_de_acciones');
        Schema::dropIfExists('evidencias');
        Schema::dropIfExists('evidencias_planes');
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('recomendaciones');
    }
}
