<?php

namespace Database\Seeders;

use App\Models\VehicleStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'Available', 'status_color' => '#28a745'], // Green
            ['name' => 'In Repair', 'status_color' => '#ffc107'], // Yellow
            ['name' => 'Out of Service', 'status_color' => '#dc3545'], // Red
            ['name' => 'Reserved', 'status_color' => '#17a2b8'], // Teal
            ['name' => 'Sold', 'status_color' => '#6c757d'], // Gray
        ];

        foreach ($statuses as $st)
        {
            VehicleStatus::create([
                'name' => $st['name'],
                'status_color' => $st['status_color']
            ]);
        }
    }
}
