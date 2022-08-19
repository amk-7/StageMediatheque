<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestitutionOuvragePhysiqueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restitution_ouvrage_physique', function (Blueprint $table) {
            $table->string('etat_ouvrage');
            $table->foreignId('id_ouvrage_physique');
            $table->foreignId('id_restitution');
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
        Schema::dropIfExists('restitution_ouvrage_physique');
    }
}
