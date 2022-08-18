<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOuvragesParReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ouvrages_par_reservations', function (Blueprint $table) {
            $table->bigInteger('id_ouvrage_physique');
            $table->bigInteger('id_reservation');
            $table->timestamps();
            $table->foreign('id_ouvrage_physique')->references('id_ouvrage_physique')->on('ouvrages_physiques');
            $table->foreign('id_reservation')->references('id_reservation')->on('reservations');
            $table->primary(['id_ouvrage_physique', 'id_reservation']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ouvrages_par_reservations');
    }
}
