<?php

namespace Database\Seeders;

use App\Enums\StatusColors;
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
            ['name' => 'Available', 'status_color' => StatusColors::SUCCESS], // Green
            ['name' => 'In Repair', 'status_color' => StatusColors::WARNING], // Yellow
            ['name' => 'Out of Service', 'status_color' => StatusColors::ERROR], // Red
            ['name' => 'Reserved', 'status_color' => StatusColors::INFO], // Teal
            ['name' => 'Sold', 'status_color' => StatusColors::DEFAULT], // Gray
        ];

        $companies = \App\Models\Company::all();

        foreach ($companies as $company) {
            foreach ($statuses as $st) {
                $company->vehicleStatuses()->create([
                    'name' => $st['name'],
                    'status_color' => $st['status_color']
                ]);
            }
        }
    }
}
