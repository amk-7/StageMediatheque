<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOuvragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ouvrages', function (Blueprint $table) {
            $table->bigIncrements('id_ouvrage');
            $table->string('titre');
            $table->json("mot_cle")->nullable();
            $table->string('resume')->nullable();
            $table->integer('annee_apparution');
            $table->string('lieu_edition');
            $table->enum('niveau', ['1', '2', '3', 'université']);
            $table->enum('type', ['roman', 'manuel scolaire', 'document technique', 'document pédagogique', 'bande dessinée', 'journeaux', 'nouvelle']);
            $table->string('image')->nullable();
            $table->string('langue')->nullable();
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
        Schema::dropIfExists('ouvrages');
    }
}
