<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovisionnementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approvisionnements', function (Blueprint $table) {
            $table->bigIncrements('id_approvisionnement');
            $table->integer('nombre_exemplaire');
            $table->enum('type_ouvrage', ['livre_papier', 'documentAV']);
            $table->timestamp('date_approvisioement')->default('now()');
            $table->bigInteger('id_ouvrage_physique');
            $table->bigInteger('id_personnel');
            $table->timestamps();
            $table->foreign('id_ouvrage_physique')->references('id_ouvrage_physique')->on('ouvrages_physiques');
            $table->foreign('id_personnel')->references('id_personnel')->on('personnels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('approvisionnements');
    }
}
