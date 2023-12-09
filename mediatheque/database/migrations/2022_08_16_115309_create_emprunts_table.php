<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpruntsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emprunts', function (Blueprint $table) {
            $table->bigIncrements('id_emprunt');
            $table->date('date_emprunt')->default('now()');
            $table->date('date_retour');
            $table->bigInteger('id_abonne')->nullable();
            $table->bigInteger('id_personnel')->nullable();
            $table->timestamps();
            $table->foreign('id_abonne')->references('id_abonne')->on('abonnes')->nullOnDelete();
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
        Schema::dropIfExists('emprunts');
    }
}
