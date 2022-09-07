<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLignesEmpruntsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lignes_emprunts', function (Blueprint $table) {
            $table->bigIncrements('id_ligne_emprunt');
            $table->bigInteger('id_ouvrage_physique')->nullable();
            $table->bigInteger('id_emprunt')->nullable();
            $table->enum("etat_sortie", [1, 2, 3, 4, 5]);
            $table->boolean("disponibilite");
            $table->timestamps();
            $table->foreign('id_ouvrage_physique')->references('id_ouvrage_physique')->on('ouvrages_physiques')->nullOnDelete();
            $table->foreign('id_emprunt')->references('id_emprunt')->on('emprunts')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lignes_emprunts');
    }
}
