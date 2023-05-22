<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchiveAbonnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archive_abonnes', function (Blueprint $table) {
            $table->bigIncrements('id_abonne');
            $table->date('date_naissance');
            $table->string('niveau_etude');
            $table->string('profession');
            $table->string('contact_a_prevenir');
            $table->string('numero_carte');
            $table->enum('type_de_carte', [0, 1]);
            $table->enum('profil_valider', [0, 1])->default(0);
            $table->bigInteger('id_utilisateur');
            $table->timestamps();
            $table->foreign('id_utilisateur')->references('id_utilisateur')->on('users');
        });

        DB::unprepared('
            CREATE OR REPLACE FUNCTION auto_insert() RETURNS trigger AS
            $$
            BEGIN
                INSERT INTO archive_abonnes (id_abonne, date_naissance, niveau_etude, profession, contact_a_prevenir, numero_carte, type_de_carte, profil_valider, id_utilisateur, created_at, updated_at)
                VALUES (new.id_abonne, new.date_naissance, new.niveau_etude, new.profession, new.contact_a_prevenir, new.numero_carte, new.type_de_carte, new.profil_valider, new.id_utilisateur, new.created_at, new.updated_at);
                RETURN new;
            END;
            $$
            language plpgsql;

            CREATE TRIGGER auto_insert
            AFTER INSERT ON abonnes
            FOR EACH ROW
            EXECUTE PROCEDURE auto_insert();

        ');
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abonnes');
        DB::unprepared('DROP TRIGGER auto_insert ON abonnes');
        DB::unprepared('DROP FUNCTION auto_insert');
    }
}
