<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnviosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envios', function (Blueprint $table) {
            $table->id();

            $table->string('remitente', 40);
            $table->string('destinatario', 40);
            $table->string('descripcion', 100);
            $table->string('destino', 40);
            $table->integer('costo');
            $table->string('estatus_pago', 15);
            $table->date('fecha_envio');
        
            $table->unsignedBigInteger('corrida_id')->nullable();
            $table->foreign('corrida_id')
                ->references('id')
                ->on('corridas')
                ->onDelete('set null');

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
        Schema::dropIfExists('envios');
    }
}
