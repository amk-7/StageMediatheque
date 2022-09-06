<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOuvrageEmpruntTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ouvrage_emprunt', function (Blueprint $table) {
            $table->foreignId('id_ouvrage_physique');
            $table->foreignId('id_emprunt');
            $table->enum("etat_sortie", [1, 2, 3, 4, 5]);
            $table->boolean("disponibilite");
            $table->timestamps();
            $table->primary(['id_ouvrage_physique', 'id_emprunt']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ouvrage_emprunt');
    }
}
