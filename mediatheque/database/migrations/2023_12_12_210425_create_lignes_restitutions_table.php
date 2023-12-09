<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLignesRestitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lignes_restitutions', function (Blueprint $table) {
            $table->bigIncrements('id_ligne_restitution');
            $table->bigInteger('id_ouvrage')->nullable();
            $table->bigInteger('id_restitution')->nullable();
            $table->enum("etat_entree", [1, 2, 3, 4, 5]);
            $table->timestamps();
            $table->foreign('id_ouvrage')->references('id_ouvrage')->on('ouvrages')->nullOnDelete();
            $table->foreign('id_restitution')->references('id_restitution')->on('restitutions')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lignes_restitutions');
    }
}
