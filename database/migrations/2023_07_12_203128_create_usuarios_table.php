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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->integer('cod_usuario')->nullable();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('nro_doc',50);
            $table->binary('huella')->nullable();//cambiar a mediumblob
            $table->binary('firma')->nullable();//cambiar a mediumblob
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
