<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barber;

class BarberSeeder extends Seeder
{
    public function run()
    {
        Barber::create(['name' => 'RIZAL']);
        Barber::create(['name' => 'HANDI']);
        Barber::create(['name' => 'ACEP']);
        Barber::create(['name' => 'ALI']);
        Barber::create(['name' => 'AYUS']);
    }
}
