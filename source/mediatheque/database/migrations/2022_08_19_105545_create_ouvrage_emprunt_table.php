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
            $table->foreignId('ouvrage_physique_id_ouvrage_physique');
            $table->foreignId('emprunt_id_emprunt');
            $table->enum("etat", [1, 2, 3, 4, 5]);
            $table->timestamps();
            $table->primary(['ouvrage_physique_id_ouvrage_physique', 'emprunt_id_emprunt']);
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
