<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuteurOuvrageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auteur_ouvrage', function (Blueprint $table) {
            $table->foreignId('id_auteur');
            $table->foreignId('id_ouvrage');
            $table->string('lieu_edition');
            $table->integer('annee_apparution');
            $table->primary(['id_auteur', 'id_ouvrage']);
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
        Schema::dropIfExists('auteur_ouvrage');
    }
}
