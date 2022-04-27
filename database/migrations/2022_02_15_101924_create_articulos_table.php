<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();

            $table->string('codigo')->unique()->nullable();
            $table->string('nombre')->unique();
            $table->decimal('precio_venta', 12, 2);
            $table->string('modelo')->unique()->nullable()->default('0');
            $table->integer('stock')->default('0');
            $table->enum('estado', ['ACTIVO', 'INACTIVO'])->default('ACTIVO');

            $table->unsignedBigInteger('marca_id')->nullable();
            $table->foreign('marca_id')->references('id')->on('marcas')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('tipo_id')->nullable();
            $table->foreign('tipo_id')->references('id')->on('tipo_equipos')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('proveedor_id')->nullable();
            $table->foreign('proveedor_id')->references('id')->on('proveedors')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulos');
    }
};
