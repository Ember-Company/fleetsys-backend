<?php

namespace Database\Seeders;

use App\Models\VehicleType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicle_types = [
            'Sedan',
            'mini-van',
            'truck'
        ];

        $companies = \App\Models\Company::all();

        foreach ($companies as $company)
        {
            foreach ($vehicle_types as $type)
            {
                $company->vehicleTypes()->create([
                    'name' => $type
                ]);
            }
        }


    }
}
