<?php

namespace Database\Seeders;

use App\Models\CurrentLocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrentLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CurrentLocation::factory(30)->create();
    }
}
