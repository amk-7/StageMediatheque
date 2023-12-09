<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id_reservation');
            $table->dateTime('date_reservation')->default('now()');
            $table->enum('etat', array(0,1))->default(1);
            $table->integer('durre')->default(24);
            $table->bigInteger('id_abonne');
            $table->bigInteger('id_ouvrage');
            $table->foreign('id_abonne')->references('id_abonne')->on('abonnes');
            $table->foreign('id_ouvrage')->references('id_ouvrage')->on('ouvrages');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
