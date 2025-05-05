<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabla Vehiculos
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id('idvehiculo');
            $table->string('placa', 50);
            $table->string('marca', 50);
            $table->string('tipo', 50);
            $table->string('estado', 50);
        });

        // Tabla Conductores
        Schema::create('conductores', function (Blueprint $table) {
            $table->id('idconductor');
            $table->string('nombre', 50);
            $table->string('dni', 8);
            $table->string('estado', 50);
        });

        // Tabla Productos
        Schema::create('productos', function (Blueprint $table) {
            $table->id('idproducto');
            $table->string('nombre', 50);
            $table->string('sku', 15);
            $table->string('estado', 50);
            $table->dateTime('fecharegistro');
        });

        // Tabla GuiaRemision
        Schema::create('guias_remision', function (Blueprint $table) {
            $table->id('idguia');
            $table->string('tim', 15);
            $table->date('fechaemision');
            $table->time('horaemision');
            $table->string('motivotraslado', 50);
            $table->string('origen', 50);
            $table->string('destino', 50);
            $table->string('estado', 50);
            $table->integer('cantidadenviada');
            $table->foreignId('idvehiculo')->constrained('vehiculos', 'idvehiculo');
            $table->foreignId('idconductor')->constrained('conductores', 'idconductor');
        });

        // Tabla DetalleGuia
        Schema::create('detalle_guias', function (Blueprint $table) {
            $table->id('iddetalleguia');
            $table->integer('cantidadrecibida');
            $table->string('estadorevision', 50);
            $table->foreignId('idguia')->constrained('guias_remision', 'idguia');
            $table->foreignId('idproducto')->constrained('productos', 'idproducto');
            $table->string('estado', 50);
        });

        // Tabla RevisionGuia
        Schema::create('revision_guias', function (Blueprint $table) {
            $table->id('idrevision');
            $table->dateTime('fecharevision');
            $table->string('rutapdf', 50);
            $table->string('rutaxcel', 50);
            $table->string('observaciones', 100);
            $table->string('estado', 50);
            $table->foreignId('idusuario')->constrained('users');
            $table->foreignId('idguia')->constrained('guias_remision', 'idguia');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('revision_guias');
        Schema::dropIfExists('detalle_guias');
        Schema::dropIfExists('guias_remision');
        Schema::dropIfExists('productos');
        Schema::dropIfExists('conductores');
        Schema::dropIfExists('vehiculos');
    }
};
