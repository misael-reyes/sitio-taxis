<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_details', function (Blueprint $table) {

            $table->integer('num_asiento');
            $table->string('estatus', 20);

            $table->unsignedBigInteger('reservation_id')->nullable(); //que acepte valores null
            $table->foreign('reservation_id')
                ->references('id')
                ->on('reservations')
                ->onDelete('set null');

            $table->unsignedBigInteger('corrida_id')->nullable(); //que acepte valores null
            $table->foreign('corrida_id')
                ->references('id')
                ->on('corridas')
                ->onDelete('set null');

            $table->unsignedBigInteger('precio_id')->nullable(); //que acepte valores null
            $table->foreign('precio_id')
                ->references('id')
                ->on('precios')
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
        Schema::dropIfExists('reservation_details');
    }
}
