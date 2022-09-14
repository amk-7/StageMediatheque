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
            $table->timestamp('date_approvisioement')->default('now()');
            $table->bigInteger('id_ouvrage_physique')->nullable();
            $table->bigInteger('id_personnel')->nullable();
            $table->timestamps();
            $table->foreign('id_ouvrage_physique')->references('id_ouvrage_physique')->on('ouvrages_physiques')->nullOnDelete();
            $table->foreign('id_personnel')->references('id_personnel')->on('personnels')->nullOnDelete();
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
