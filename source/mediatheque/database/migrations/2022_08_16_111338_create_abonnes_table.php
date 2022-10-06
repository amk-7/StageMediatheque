<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbonnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonnes', function (Blueprint $table) {
            $table->bigIncrements('id_abonne');
            $table->date('date_naissance');
            $table->string('niveau_etude');
            $table->string('profession');
            $table->string('contact_a_prevenir');
            $table->string('numero_carte');
            $table->string('type_de_carte');
            $table->bigInteger('id_utilisateur');
            $table->timestamps();
            $table->foreign('id_utilisateur')->references('id_utilisateur')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abonnes');
    }
}
