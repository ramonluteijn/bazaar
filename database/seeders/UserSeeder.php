<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'user']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'owner']);
        Role::create(['name' => 'private_advertiser']);
        Role::create(['name' => 'business_advertiser']);

        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@bazaar.nl';
        $user->password = Hash::make('test1234');
        $user->save();
        $user->assignRole('admin');

        $user = new User();
        $user->name = 'Owner';
        $user->email = 'owner@bazaar.nl';
        $user->password = Hash::make('test1234');
        $user->save();
        $user->assignRole('owner');

        User::factory(5)->create()->each(function ($user) {
            $user->assignRole('user');
        });
        User::factory(5)->create()->each(function ($user) {
            $user->assignRole('private_advertiser');
        });
        User::factory(5)->create()->each(function ($user) {
            $user->assignRole('business_advertiser');
        });
    }
}
