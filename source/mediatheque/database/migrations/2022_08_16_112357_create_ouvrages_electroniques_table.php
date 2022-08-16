<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOuvragesElectroniquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ouvrages_electroniques', function (Blueprint $table) {
            $table->bigIncrements('id_ouvrage_electronique');
            $table->string('url');
            $table->bigInteger('id_ouvrage');
            $table->timestamps();
            $table->foreign('id_ouvrage')->references('id_ouvrage')->on('ouvrages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ouvrages_electroniques');
    }
}
