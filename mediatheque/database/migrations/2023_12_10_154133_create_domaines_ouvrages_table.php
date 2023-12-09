<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomainesOuvragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domaines_ouvrages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_ouvrage')->nullable();
            $table->bigInteger('id_domaine')->nullable();
            $table->timestamps();
            $table->foreign('id_domaine')->references('id_domaine')->on('domaines')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('domaines_ouvrages');
    }
}
