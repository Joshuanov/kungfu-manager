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
    Schema::create('examenes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('alumno_id')->constrained()->onDelete('cascade');
        $table->enum('tipo', ['Tradicional', 'Sanda']);
        $table->enum('categoria', ['Tiger', 'Junior', 'Adulto', 'Senior']);
        $table->enum('nivel', ['Básico', 'Intermedio', 'Avanzado', 'Faja negra']);
        $table->date('fecha_examen');
        $table->boolean('aprobado')->default(false);
        $table->timestamps();
    });
}

};
