<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restitutions', function (Blueprint $table) {
            $table->bigIncrements('id_restitution');
            $table->date('date_restitution')->default('now()');
            $table->bigInteger('id_abonne');
            $table->foreign('id_abonne')->references('id_abonne')->on('abonnes');
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
        Schema::dropIfExists('restitutions');
    }
}
