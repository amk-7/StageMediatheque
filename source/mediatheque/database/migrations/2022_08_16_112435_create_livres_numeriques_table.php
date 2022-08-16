<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivresNumeriquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livres_numeriques', function (Blueprint $table) {
            $table->bigIncrements('id_livre_numerique');
            $table->string('categorie');
            $table->string('ISBN')->unique();
            $table->bigInteger('id_ouvrage_electronique');
            $table->timestamps();
            $table->foreign('id_ouvrage_electronique')->references('id_ouvrage_electronique')->on('ouvrages_electroniques');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livres_numeriques');
    }
}