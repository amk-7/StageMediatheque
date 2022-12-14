<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->bigIncrements('id_registration');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->enum('etat', [0, 1])->default(1);
            $table->bigInteger('id_abonne');
            $table->bigInteger('id_tarif_abonnement');
            $table->foreign('id_abonne')->references('id_abonne')->on('abonnes');
            $table->foreign('id_tarif_abonnement')->references('id_tarif_abonnement')->on('tarif_abonnements');
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
        Schema::dropIfExists('registrations');
    }
}
