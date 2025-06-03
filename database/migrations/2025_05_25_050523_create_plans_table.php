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

        $table->string('nombre');
        $table->integer('duracion_meses');

        $table->decimal('monto_total', 10, 2)->nullable();
        $table->decimal('monto_base_mensual', 10, 2);
        $table->integer('pago_inicial')->nullable();

        $table->string('tipo_plan_pago'); // Ej: 'mensual', 'único', etc.

        $table->integer('cant_clases_tradicional')->default(0);
        $table->integer('cant_clases_sanda')->default(0);
        $table->integer('cant_clases_extra')->default(0);

        $table->timestamps();
    });
}


};
