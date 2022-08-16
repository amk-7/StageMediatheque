<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id_utilisateur');
            $table->string('nom');
            $table->string('prenom');
            $table->string('nom_utilisateur')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('contact');
            $table->string('photo_profil');
            $table->json('adresse');
            $table->string('sexe');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
