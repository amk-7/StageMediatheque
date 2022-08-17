<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassificationDeweyCentainesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classification_dewey_centaines', function (Blueprint $table) {
            $table->bigIncrements('id_classification_dewey_centaine');
            $table->bigInteger('section')->unique();
            $table->string('theme')->unique();
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
        Schema::dropIfExists('classification_dewey_centaines');
    }
}
