<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restitutions', function (Blueprint $table) {
            $table->bigIncrements('id_restitution');
            $table->boolean('etat');
            $table->date('date_restitution')->default('now()');
            $table->bigInteger('id_abonne')->nullable();
            $table->bigInteger('id_personnel')->nullable();
            $table->bigInteger('id_emprunt')->nullable();
            $table->timestamps();
            $table->foreign('id_abonne')->references('id_abonne')->on('abonnes')->nullOnDelete();
            $table->foreign('id_personnel')->references('id_personnel')->on('personnels')->nullOnDelete();
            $table->foreign('id_emprunt')->references('id_emprunt')->on('emprunts')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restitutions');
    }
}
