<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabla Transporte
        Schema::create('transporte', function (Blueprint $table) {
            $table->id('idtransportista');
            $table->string('ruc_transportista', 11);
            $table->string('nombre_razonsocial', 100);
            $table->string('estado', 20);
            $table->timestamps();
        });

        // Tabla Vehiculos
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id('idvehiculo');
            $table->string('placa', 10);
            $table->string('marca', 50);
            $table->string('tipo', 50);
            $table->string('estado', 20);
            $table->timestamps();
        });

        // Tabla Conductores
        Schema::create('conductores', function (Blueprint $table) {
            $table->id('idconductor');
            $table->string('nombre', 100);
            $table->string('dni', 8);
            $table->string('estado', 20);
            $table->foreignId('idtransportista')->constrained('transporte', 'idtransportista');
            $table->foreignId('idvehiculo')->constrained('vehiculos', 'idvehiculo');
            $table->timestamps();
        });

        // Tabla TipoEmpresa
        Schema::create('tipoempresa', function (Blueprint $table) {
            $table->id('idtipoempresa');
            $table->string('direccion', 100);
            $table->string('provincia', 50);
            $table->string('departamento', 50);
            $table->string('ubigeo', 6);
            $table->string('razonsocial', 100);
            $table->string('ruc', 11);
            $table->string('codigoestablecimiento', 10);
            $table->string('estado', 20);
            $table->timestamps();
        });

        // Tabla Productos
        Schema::create('productos', function (Blueprint $table) {
            $table->id('idproducto');
            $table->string('codigoproducto', 20);
            $table->string('nombre', 100);
            $table->string('tipocodproducto', 50);
            $table->string('tipoinventario', 50);
            $table->dateTime('fecharegistro');
            $table->string('estado', 20);
            $table->timestamps();
        });

        // Tabla GuiaRemision
        Schema::create('guiaremision', function (Blueprint $table) {
            $table->id('idguia');
            $table->string('codigoguia', 20);
            $table->date('fechaemision');
            $table->time('horaemision');
            $table->string('razonsocialguia', 100);
            $table->string('numerotrasladotim', 20);
            $table->string('motivotraslado', 100);
            $table->decimal('pesobrutototal', 10, 2);
            $table->decimal('volumenproducto', 10, 2);
            $table->integer('numerobultopallet');
            $table->string('observaciones');
            $table->foreignId('idconductor')->constrained('conductores', 'idconductor');
            $table->foreignId('idtipoempresa')->constrained('tipoempresa', 'idtipoempresa');
            $table->timestamps();
        });

        // Tabla DetalleGuiaRemision
        Schema::create('detalleguia', function (Blueprint $table) {
            $table->id('iddetalleguia');
            $table->foreignId('idguia')->constrained('guiaremision', 'idguia');
            $table->foreignId('idproducto')->constrained('productos', 'idproducto');
            $table->string('condicion', 20);
            $table->integer('cantrecibida');
            $table->timestamps();
        });

        // Tabla Validacion
        Schema::create('validacion', function (Blueprint $table) {
            $table->id('idvalidacion');
            $table->string('estado', 20);
            $table->integer('cantrecibidarevision');
            $table->foreignId('idguia')->constrained('guiaremision', 'idguia');
            $table->foreignId('idproducto')->constrained('productos', 'idproducto');
            $table->foreignId('idtipocondicion')->constrained('tipocondicion', 'idtipocondicion');
            $table->timestamps();
        });

        // Tabla RevisionGuia
        Schema::create('revisionguia', function (Blueprint $table) {
            $table->id('idrevision');
            $table->date('fecharevision');
            $table->string('rutapdf', 255);
            $table->string('rutaxcel', 255);
            $table->text('observaciones')->nullable();
            $table->foreignId('idusuario')->constrained('users');
            $table->foreignId('iddetalleguia')->constrained('detalleguia', 'iddetalleguia');
            $table->foreignId('idvalidacion')->constrained('validacion', 'idvalidacion');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('revisionguia');
        Schema::dropIfExists('validacion');
        Schema::dropIfExists('detalleguia');
        Schema::dropIfExists('guiaremision');
        Schema::dropIfExists('productos');
        Schema::dropIfExists('tipoempresa');
        Schema::dropIfExists('conductores');
        Schema::dropIfExists('vehiculos');
        Schema::dropIfExists('transporte');
    }
};
