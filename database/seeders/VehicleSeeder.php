<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use App\Models\VehicleStatus;
use App\Models\VehicleType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $MASTER_NAME = 'Master Company';
        $companies = \App\Models\Company::all()->where('name', '!=', $MASTER_NAME);

        $v_type = VehicleType::all()->random();
        $v_status = VehicleStatus::all()->random();

        foreach ($companies as $company)
        {

            Vehicle::factory()->create([
                'company_id' => $company->id,
                'vehicle_type_id' => $v_type->id,
                'vehicle_status_id' => $v_status->id
            ]);
        }
    }
}
