<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOuvragesPhysiquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ouvrages_physiques', function (Blueprint $table) {
            $table->bigIncrements('id_ouvrage_physique');
            $table->integer('nombre_exemplaire');
            $table->string('etat');
            $table->boolean('disponibilite');
            $table->bigInteger('id_ouvrage');
            $table->timestamps();
            $table->foreign('id_ouvrage')->references('id_ouvrage')->on('ouvrages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ouvrages_physiques');
    }
}
