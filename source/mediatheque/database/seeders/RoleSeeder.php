<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public static function run()
    {
        //Liste des roles
        $roles = [
            'responsable',
            'bibliothecaire',
            'abonne',
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}

?>
