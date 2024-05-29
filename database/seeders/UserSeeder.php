<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create roles if they don't exist
        $roles = ['Admin', 'Barber', 'Customer'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Create admin user
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'), // Change this to a secure password
        ]);
        $admin->assignRole('Admin');

        // Create barber user
        $barber = User::create([
            'name' => 'Ujang',
            'email' => 'ujang@gmail.com',
            'password' => Hash::make('12345678'), // Change this to a secure password
        ]);
        $barber->assignRole('Barber');

        // Create customer user
        $customer = User::create([
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('12345678'), // Change this to a secure password
        ]);
        $customer->assignRole('Customer');
    }
}
