<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $company = \App\Models\Company::where('name', 'Master')->first();

        if($company)
        {
            \App\Models\User::create([
                'name' => 'MasterUser',
                'email' => 'master@user.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),

                'company_id' => $company->id,
                'role' => 0
            ]);
        }
        // $companies = \App\Models\Company::all();

        // foreach ($companies as $company)
        // {
        //     \App\Models\User::factory(1)->create([
        //         'company_id' => $company->id,
        //         'role' => 1
        //     ]);
        // }
    }
}
