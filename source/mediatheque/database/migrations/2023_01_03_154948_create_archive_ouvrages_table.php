<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchiveOuvragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archive_ouvrages', function (Blueprint $table) {
            $table->bigIncrements('id_ouvrage');
            $table->string('titre');
            $table->json("mot_cle")->nullable();
            $table->string('resume')->nullable();
            $table->integer('annee_apparution')->nullable();
            $table->string('lieu_edition')->nullable();
            $table->enum('niveau', ['1', '2', '3', 'université']);
            //$table->enum('type', ['droit', 'comptabilité', 'roman', 'manuel scolaire', 'document technique', 'document pédagogique', 'bande dessinée', 'journeaux', 'nouvelle']);
            $table->string('type');
            $table->string('image')->nullable();
            $table->string('langue')->nullable();
            $table->timestamps();
        });

        DB::unprepared('
            CREATE OR REPLACE FUNCTION archive_ouvrages() RETURNS TRIGGER AS $$
            BEGIN
                INSERT INTO archive_ouvrages (id_ouvrage, titre, mot_cle, resume, annee_apparution, lieu_edition, niveau, type, image, langue, created_at, updated_at)
                VALUES (new.id_ouvrage, new.titre, new.mot_cle, new.resume, new.annee_apparution, new.lieu_edition, new.niveau, new.type, new.image, new.langue, new.created_at, new.updated_at);
                RETURN new;
            END;
            $$
            LANGUAGE plpgsql;

            CREATE TRIGGER archive_ouvrages
            AFTER INSERT ON ouvrages
            FOR EACH ROW
            EXECUTE PROCEDURE archive_ouvrages();
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archive_ouvrages');
        DB::unprepared('DROP TRIGGER IF EXISTS archive_ouvrages ON ouvrages');
        DB::unprepared('DROP FUNCTION IF EXISTS archive_ouvrages()');
    }
}
