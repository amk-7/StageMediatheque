<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleHasPermissionSeeder extends Seeder
{
    public static function run()
    {
        $role_responsable = Role::find(1);
        $role_responsable->syncPermissions(Permission::all());

        $role_bibliothecaire = Role::find(2);
        $rollback_permission = [
            "livres_papier_create",
            "livres_numerique_create",
            "approvisionnement_index",
            "approvisionnement_create",
            "approvisionnement_store",
            "approvisionnement_show",
            "approvisionnement_edite",
            "approvisionnement_update",
            "approvisionnement_delete",
            "personnel_create",
        ];


        foreach (Permission::all() as $permission)
        {
            if (! in_array($permission->name, $rollback_permission, true))
            {
                $role_bibliothecaire->givePermissionTo($permission);
            }
        }

        $role_abonne = Role::find(3);
        $permission_role_abonne = [
            "abonne_index",
            "abonne_create",
            "abonne_store",
            "abonne_show",
            "abonne_edite",
            "abonne_update",
            "abonne_delete",

            "livres_papier_index",
            "livres_papier_show",

            "livres_numerique_index",
            "livres_numerique_show",
        ];

        foreach ($permission_role_abonne as $permission)
        {
            $role_abonne->givePermissionTo($permission);
        }
    }
}

?>
