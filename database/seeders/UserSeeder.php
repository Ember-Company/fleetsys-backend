<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = \App\Models\Company::all();

        foreach ($companies as $company)
        {
            \App\Models\User::factory(3)->create([
                'company_id' => $company->id
            ]);
        }
    }
}
