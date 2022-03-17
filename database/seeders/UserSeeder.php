<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create 20 more users
       User::factory(20)->create();
        //made admin arcoded
        User::factory()->create([
            'first-name' => 'Admin',
            'last-name' => 'Admin',
            'email' => 'admin@admin.com',
            'role_id' => 1,
        ]);
        //made editor arcoded
        User::factory()->create([
            'first-name' => 'Editor',
            'last-name' => 'Editor',
            'email' => 'editor@editor.com',
            'role_id' => 2,
        ]);
        //made admin viewer
        User::factory()->create([
            'first-name' => 'Viewer',
            'last-name' => 'Viewer',
            'email' => 'viewer@viewer.com',
            'role_id' => 3,
        ]);
    }
}
