<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activites', function (Blueprint $table) {
            $table->bigIncrements('id_activite');
            $table->text('ouvrages');
            $table->text('sugestions');
            $table->bigInteger('id_abonne');
            $table->timestamps();
            $table->foreign('id_abonne')->references('id_abonne')->on('abonnes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activites');
    }
}
