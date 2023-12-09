<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOuvragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ouvrages', function (Blueprint $table) {
            $table->bigIncrements('id_ouvrage');
            $table->text('cote');
            $table->text('titre');
            $table->json("mot_cle")->nullable();
            $table->text('resume')->nullable();
            $table->integer('annee_apparution')->nullable();
            $table->string('lieu_edition')->nullable();
            $table->bigInteger('id_niveau')->nullable();
            $table->bigInteger('id_type')->nullable();
            $table->text('image')->nullable();
            $table->bigInteger('id_langue')->nullable();
            $table->text('ressources_externe')->nullable();
            $table->string('isbn')->nullable();
            $table->integer('nombre_exemplaire')->nullable();
            $table->text('documents')->nullable();
            $table->timestamps();
            $table->foreign('id_type')->references('id_type_ouvrage')->on('types_ouvrages')->nullOnDelete();
            $table->foreign('id_langue')->references('id_langue')->on('langues')->nullOnDelete();
            $table->foreign('id_niveau')->references('id_niveau')->on('niveaux')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ouvrages');
    }
}
