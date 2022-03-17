<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //made custom role
        $admin = Role::factory()->create([
            'name' => 'Admin'
        ]);
        $editor = Role::factory()->create([
            'name' => 'Editor'
        ]);

        $viewer = Role::factory()->create([
            'name' => 'Viewer'
        ]);
        $permissions = Permission::all();

        //write role-permissions table
//        foreach ($permissions as $permission) {
//          \DB::table('role_permissions')->insert([
//             'permissions_id' => $permission ->id,
//             'role_id' => $admin->id
//          ]);
        //}
        //or better
         //admin
         $admin->permissions()->attach($permissions->pluck('id'));
         //editor
         $editor->permissions()->attach($permissions->pluck('id'));
         //exclude number 4 editor role not have permissions
         $editor->permissions()->detach(4);
         //viewer attach only view permission
         $viewer->permissions()->attach([1, 3, 5, 7]);

    }
}
