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
    Schema::create('plans', function (Blueprint $table) {
        $table->id();
        $table->string('nombre'); // Básico, Avanzado, etc.
        $table->decimal('monto_mensual', 10, 2);
        $table->integer('duracion_meses');
        $table->integer('asistencias_semanales');
        $table->timestamps();
    });
}

};
