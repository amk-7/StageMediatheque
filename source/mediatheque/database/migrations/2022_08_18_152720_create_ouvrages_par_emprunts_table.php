<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOuvragesParEmpruntsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ouvrages_par_emprunts', function (Blueprint $table) {
            $table->bigInteger('id_ouvrage_physique');
            $table->bigInteger('id_emprunt');
            $table->timestamps();
            $table->foreign('id_ouvrage_physique')->references('id_ouvrage_physique')->on('ouvrages_physiques');
            $table->foreign('id_emprunt')->references('id_emprunt')->on('emprunts');
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
        Schema::dropIfExists('ouvrages_par_emprunts');
    }
}
