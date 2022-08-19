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
            $table->foreignId('auteur_id_auteur');
            $table->foreignId('ouvrage_id_ouvrage');
            $table->string('lieu_edition')->nullable();
            $table->date('date_apparution')->nullable();
            $table->primary(['auteur_id_auteur', 'ouvrage_id_ouvrage']);
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
