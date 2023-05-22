<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ArchiveLivresPapiers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('archive_livres_papiers', function (Blueprint $table) {
            $table->bigIncrements('id_livre_papier');
            $table->json('categorie');
            $table->string('isbn')->nullable();
            $table->bigInteger('id_ouvrage_physique');
            $table->timestamps();
            $table->foreign('id_ouvrage_physique')->references('id_ouvrage_physique')->on('ouvrages_physiques')->cascadeOnDelete();
        });

        DB::unprepared('
            CREATE OR REPLACE FUNCTION insert_livres_papiers() RETURNS trigger AS
            $$
            BEGIN
                INSERT INTO archive_livres_papiers (id_livre_papier, categorie, isbn, id_ouvrage_physique, created_at, updated_at)
                VALUES (new.id_livre_papier, new.categorie, new.isbn, new.id_ouvrage_physique, new.created_at, new.updated_at);
                RETURN new;
            END;
            $$
            LANGUAGE plpgsql;

            CREATE TRIGGER insert_livres_papiers
            AFTER INSERT ON livres_papiers
            FOR EACH ROW
            EXECUTE PROCEDURE insert_livres_papiers();

        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('archive_livres_papiers');
        DB::unprepared('DROP TRIGGER insert_ouvrage ON ouvrages_physiques');
        DB::unprepared('DROP FUNCTION insert_ouvrage');
    }
}
