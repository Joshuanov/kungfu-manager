<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alumno_plan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('alumno_id')->constrained('alumnos')->onDelete('cascade');
            $table->foreignId('plan_id')->constrained('plans')->onDelete('restrict');

            $table->date('fecha_inicio');
            $table->integer('duracion_meses');
            $table->string('estado');
            $table->integer('num_cuotas');
            $table->integer('monto_cuota');
            $table->integer('pago_inicial')->nullable();
            $table->text('observaciones')->nullable();
            $table->integer('meses_congelados')->default(0);
            $table->date('fecha_fin_real')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumno_plan');
    }
};
