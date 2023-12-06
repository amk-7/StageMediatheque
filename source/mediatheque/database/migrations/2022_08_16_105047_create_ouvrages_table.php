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
            $table->text('titre');
            $table->json("mot_cle")->nullable();
            $table->text('resume')->nullable();
            $table->integer('annee_apparution')->nullable();
            $table->string('lieu_edition')->nullable();
            $table->enum('niveau', ['1', '2', '3', 'université']);
            $table->string('type')->nullable();
            $table->string('image')->nullable();
            $table->string('langue')->nullable();
            $table->string('ressources_externe')->nullable();
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
