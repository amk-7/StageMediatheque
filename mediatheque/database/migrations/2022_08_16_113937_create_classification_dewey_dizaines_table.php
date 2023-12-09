<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassificationDeweyDizainesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classification_dewey_dizaines', function (Blueprint $table) {
            $table->bigIncrements('id_classification_dewey_dizaine');
            $table->integer('classe')->unique();
            $table->string('matiere')->unique();
            $table->bigInteger('id_classification_dewey_centaine');
            $table->timestamps();
            $table->foreign('id_classification_dewey_centaine')->references('id_classification_dewey_centaine')->on('classification_dewey_centaines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classification_dewey_dizaines');
    }
}
