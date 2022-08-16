<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuteursParOuvragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auteurs_par_ouvrages', function (Blueprint $table) {
            $table->bigIncrements('id_auteur_par_ouvrage');
            $table->bigInteger('id_auteur');
            $table->bigInteger('id_ouvrage');
            $table->timestamps();
            $table->foreign('id_auteur')->references('id_auteur')->on('auteurs');
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
        Schema::dropIfExists('auteurs_par_ouvrages');
    }
}
