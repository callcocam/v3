<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        
        \App\Models\User::query()->forceDelete();
        \App\Models\User::factory(500)->create();

        $user =    \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        \App\Models\Role::query()->forceDelete();
        
        $role =  \App\Models\Role::factory()->create([
            'name' => 'Super Admin',
            'slug' => 'super-admin',
            'special'=>'all-access'
        ]);
        $user->roles()->sync([$role->id->toString()]);
    }
}
