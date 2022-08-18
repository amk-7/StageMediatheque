<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOuvragesParRestitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ouvrages_par_restitutions', function (Blueprint $table) {
            $table->string('etat_ouvrage');
            $table->bigInteger('id_restitution');
            $table->bigInteger('id_ouvrage_physique');
            $table->foreign('id_restitution')->references('id_restitution')->on('restitutions');
            $table->foreign('id_ouvrage_physique')->references('id_ouvrage_physique')->on('ouvrages_physiques');
            $table->primary(['id_restitution', 'id_ouvrage_physique']);
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
        Schema::dropIfExists('ouvrages_par_restitutions');
    }
}
