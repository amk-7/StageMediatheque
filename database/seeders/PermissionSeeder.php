<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public static function run()
    {
        // Liste des permissions.
        $permissions = [
            "livres_papier_index",
            "livres_papier_create",
            "livres_papier_store",
            "livres_papier_show",
            "livres_papier_edite",
            "livres_papier_update",
            "livres_papier_delete",

            "livres_numerique_index",
            "livres_numerique_create",
            "livres_numerique_store",
            "livres_numerique_show",
            "livres_numerique_edite",
            "livres_numerique_update",
            "livres_numerique_delete",

            "approvisionnement_index",
            "approvisionnement_create",
            "approvisionnement_store",
            "approvisionnement_show",
            "approvisionnement_edite",
            "approvisionnement_update",
            "approvisionnement_delete",

            "emprunt_index",
            "emprunt_create",
            "emprunt_store",
            "emprunt_show",
            "emprunt_edite",
            "emprunt_update",
            "emprunt_delete",

            "restitution_index",
            "restitution_create",
            "restitution_store",
            "restitution_show",
            "restitution_edite",
            "restitution_update",
            "restitution_delete",

            "abonne_index",
            "abonne_create",
            "abonne_store",
            "abonne_show",
            "abonne_edite",
            "abonne_update",
            "abonne_delete",

            "personnel_index",
            "personnel_create",
            "personnel_store",
            "personnel_show",
            "personnel_edite",
            "personnel_update",
            "personnel_delete",

        ];

        foreach ($permissions as $permission)
        {
            Permission::create(['name'=>$permission]);
        }
    }
}
?>
