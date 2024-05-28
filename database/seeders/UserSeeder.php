<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::find(4);
        $user->assignRole('Admin');

        $user = User::find(1);
        $user->assignRole('Barber');

        $user = User::find(5);
        $user->assignRole('Customer');
    }
}
