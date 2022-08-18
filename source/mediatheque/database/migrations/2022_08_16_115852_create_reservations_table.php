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
            $table->date('date_reservation')->default('now()');
            $table->bigInteger('id_abonne');
            $table->bigInteger('id_ouvrage_physique');
            $table->foreign('id_abonne')->references('id_abonne')->on('abonnes');
            $table->foreign('id_ouvrage_physique')->references('id_ouvrage_physique')->on('ouvrages_physiques');
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
        Schema::dropIfExists('reservations');
    }
}
