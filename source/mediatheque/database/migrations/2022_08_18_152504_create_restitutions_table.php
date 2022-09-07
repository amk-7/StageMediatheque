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
            $table->enum('etat', [-1,0,1]);
            $table->date('date_restitution')->default('now()');
            $table->bigInteger('id_abonne')->nullable();
            $table->bigInteger('id_personnel')->nullable();
            $table->timestamps();
            $table->foreign('id_abonne')->references('id_abonne')->on('abonnes')->nullOnDelete();
            $table->foreign('id_personnel')->references('id_personnel')->on('personnels')->nullOnDelete();
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
