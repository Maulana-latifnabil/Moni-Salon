<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::find();
        $user->assignRole('Admin');

        $user = User::find();
        $user->assignRole('Barber');

        $user = User::find();
        $user->assignRole('Customer');
    }
}
