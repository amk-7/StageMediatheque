<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOuvrageReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ouvrage_reservation', function (Blueprint $table) {
            $table->foreignId('ouvrage_physique_id_ouvrage_physique');
            $table->foreignId('reservation_id_reservation');
            $table->timestamps();
            $table->primary(['ouvrage_physique_id_ouvrage_physique', 'reservation_id_reservation']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ouvrage_reservation');
    }
}
