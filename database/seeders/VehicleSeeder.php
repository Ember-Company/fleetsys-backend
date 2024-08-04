<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use App\Models\VehicleStatus;
use App\Models\VehicleType;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $MASTER_NAME = 'Master Company';
        $companies = \App\Models\Company::all()->where('name', '!=', $MASTER_NAME);

        foreach ($companies as $company)
        {
            $v_type = $company->vehicleTypes()->get()->random();
            $v_status = $company->vehicleStatuses()->get()->random();

            Vehicle::factory()->create([
                'company_id' => $company->id,
                'vehicle_type_id' => $v_type->id,
                'vehicle_status_id' => $v_status->id
            ]);
        }
    }
}
