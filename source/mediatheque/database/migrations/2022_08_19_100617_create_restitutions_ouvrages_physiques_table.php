<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestitutionsOuvragesPhysiquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restitutions_ouvrages_physiques', function (Blueprint $table) {
            $table->foreignId('id_ouvrage_physique');
            $table->foreignId('id_restitution');
            $table->enum("etat_ouvrage", [1, 2, 3, 4, 5]);
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
