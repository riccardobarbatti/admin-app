<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //made custom role
        Role::factory()->create([
            'name' => 'Admin'
        ]);
        Role::factory()->create([
            'name' => 'Editor'
        ]);

        Role::factory()->create([
            'name' => 'Viewer'
        ]);


        //create 20 more users
         \App\Models\User::factory(20)->create();
        //made admin arcoded
        \App\Models\User::factory()->create([
            'first-name' => 'Admin',
            'last-name' => 'Admin',
            'email' => 'admin@admin.com',
            'role_id' => 1,
        ]);
        //made editor arcoded
        \App\Models\User::factory()->create([
            'first-name' => 'Editor',
            'last-name' => 'Editor',
            'email' => 'editor@editor.com',
            'role_id' => 2,
        ]);
        //made admin viewer
        \App\Models\User::factory()->create([
            'first-name' => 'Viewer',
            'last-name' => 'Viewer',
            'email' => 'viewer@viewer.com',
            'role_id' => 3,
        ]);
    }
}
