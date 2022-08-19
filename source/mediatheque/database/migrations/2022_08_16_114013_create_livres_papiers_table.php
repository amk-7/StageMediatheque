<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivresPapiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livres_papiers', function (Blueprint $table) {
            $table->bigIncrements('id_livre_papier');
            $table->enum('categorie', ['français', 'anglais', 'allemand', 'physique', 'education',
                'hydrolique', 'musique et art', 'théologie', 'philosophie', 'zoologie', 'géologie', 'mathématique générale',
                'bibliographie', 'physique', 'médécine', 'comptabilité', 'droit']);
            $table->string('ISBN')->unique();
            $table->bigInteger('id_ouvrage_physique');
            $table->timestamps();
            $table->foreign('id_ouvrage_physique')->references('id_ouvrage_physique')->on('ouvrages_physiques');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livres_papiers');
    }
}
