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
    Schema::create('reuniones', function (Blueprint $table) {
        $table->id();
        $table->foreignId('alumno_id')->constrained()->onDelete('cascade');
        $table->date('fecha');
        $table->string('motivo');
        $table->timestamps();
    });
}

};
