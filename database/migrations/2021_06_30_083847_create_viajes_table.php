<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viajes', function (Blueprint $table) {
            $table->id();

            $table->string('cliente', 40);
            $table->date('fecha_inicio');
            $table->date('fecha_final');
            $table->string('origen', 40);
            $table->string('destino', 40);
            $table->integer('costo');

            $table->unsignedBigInteger('cab_id')->nullable();
            $table->foreign('cab_id')
                ->references('id')
                ->on('cabs')
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
        Schema::dropIfExists('viajes');
    }
}
