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
        $table->string('apellido');
        $table->string('rut')->unique();
        $table->string('telefono')->nullable();
        $table->enum('nivel', ['Tiger', 'Junior', 'Adulto', 'Senior']);
        $table->foreignId('plan_id')->constrained()->onDelete('cascade');
        $table->date('fecha_inicio_plan');
        $table->boolean('congelado')->default(false);
        $table->timestamps();
    });
}

};
