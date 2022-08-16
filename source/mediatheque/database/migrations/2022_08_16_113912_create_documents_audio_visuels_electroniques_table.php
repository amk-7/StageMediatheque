<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsAudioVisuelsElectroniquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents_audio_visuels_electroniques', function (Blueprint $table) {
            $table->bigIncrements('id_document_audio_visuel_electronique');
            $table->string('genre');
            $table->string('ISAN')->unique();
            $table->bigInteger('id_ouvrage_electronique');
            $table->timestamps();
            $table->foreign('id_ouvrage_electronique')->references('id_ouvrage_electronique')->on('ouvrages_electroniques');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents_audio_visuels_electroniques');
    }
}
