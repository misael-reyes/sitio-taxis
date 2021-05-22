<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ForeignKeyDefinition;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();

            $table->string('nombre',40);
            $table->string('apellidoPaterno', 40);
            $table->string('apellidoMaterno', 40)->nullable();
            $table->string('num_celular', 10)->unique();
            $table->string('dir_calle', 40);
            $table->string('dir_numero', 10);
            $table->string('dir_localidad', 40);

            $table->unsignedBigInteger('cab_id')->unique()->nullable(); //relación 1,1 y que acepte valores null
            $table->foreign('cab_id')
                ->references('id')
                ->on('cabs')
                ->onDelete('set null') //que cuando se elemine un taxi, el chofer permanece, pero ahora sin taxi
                ->onUpdate('cascade'); //por si al taxi se le ocurre cambiar su id

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
        Schema::dropIfExists('drivers');
    }
}
