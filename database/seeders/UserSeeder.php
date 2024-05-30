<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permission Manage User('Admin')
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'assign roles']);

        //Permission Manage Role & Permission ('Admin')
        Permission::create(['name' => 'manage roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'edit roles']);
        Permission::create(['name' => 'delete roles']);
        Permission::create(['name' => 'manage permissions']);
        Permission::create(['name' => 'assign permissions']);

        //Permission Manage Booking & Service ('Admin & Barber')
        Permission::create(['name' => 'view bookings']);
        Permission::create(['name' => 'manage bookings']);
        Permission::create(['name' => 'create services']);
        Permission::create(['name' => 'edit services']);
        Permission::create(['name' => 'delete services']);
        Permission::create(['name' => 'view services']);

        //Permission Manage Own Booking ('Customer')
        Permission::create(['name' => 'create bookings']);
        Permission::create(['name' => 'edit bookings']);
        Permission::create(['name' => 'cancel bookings']);
        Permission::create(['name' => 'view own bookings']);

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'Admin']);
        $adminRole->givePermissionTo(Permission::all());

        $barberRole = Role::create(['name' => 'Barber']);
        $barberRole->givePermissionTo([
            'view bookings',
            'manage bookings',
            'create services',
            'edit services',
            'delete services',
            'view services'
        ]);

        $customerRole = Role::create(['name' => 'Customer']);
        $customerRole->givePermissionTo([
            'create bookings',
            'edit bookings',
            'cancel bookings',
            'view own bookings'
        ]);

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
