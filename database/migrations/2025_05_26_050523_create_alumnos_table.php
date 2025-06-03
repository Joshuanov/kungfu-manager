<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('alumnos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('apellido_paterno');
        $table->string('apellido_materno');
        $table->integer('edad');
        $table->string('rut')->unique();
        $table->string('telefono')->nullable();
        $table->string('correo')->nullable();
        //NIVELES
        $table->enum('nivel', ['Tiger Team', 'Junior', 'Básico', 'Intermedio', 'Avanzado', 'Sanda', 'Fajas Negras']);
        //GRADOS
        $table->enum('grado', ['Amarillo', 'Dorado', 'Naranjo', 'Jade', 'Verde', 'Violeta', 'Azul', 'Rojo', 'Café', 'Café avanzado', 'Negro', 'Negro I', 'Negro II', 'Negro III', 'Amarillo Jr', 'Dorado Jr', 'Naranjo Jr', 'Jade Jr', 'Verde Jr', 'Violeta Jr', 'Azul Jr', 'Rojo Jr', 'Café Jr', 'Café avanzado Jr', 'Tiger Blanco', 'Tiger Amarillo', 'Tiger Violeta', 'Tiger Verde','Tiger Rojo']);

        $table->text('comentario')->nullable();
        $table->enum('estado', ['activo', 'retirado', 'congelado'])->default('activo');
        $table->boolean('congelado')->default(false);
        $table->timestamps();
    });
}

};
