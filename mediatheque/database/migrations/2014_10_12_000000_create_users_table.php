<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id_utilisateur');
            $table->string('nom');
            $table->string('prenom');
            $table->string('nom_utilisateur')->unique();
            $table->string('email')->nullable();
            $table->string('password');
            $table->string('contact')->nullable();
            $table->string('photo_profil');
            $table->json('adresse');
            $table->string('sexe');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
