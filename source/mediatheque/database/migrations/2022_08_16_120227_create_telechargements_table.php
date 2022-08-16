<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelechargementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telechargements', function (Blueprint $table) {
            $table->bigIncrements('id_telechargement');
            $table->timestamp('date');
            $table->bigInteger('id_ouvrage_electronique');
            $table->bigInteger('id_abonne');
            $table->timestamps();
            $table->foreign('id_ouvrage_electronique')->references('id_ouvrage_electronque')->on('ouvrages_electroniques');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telechargements');
    }
}
