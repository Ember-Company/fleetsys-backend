<?php

namespace Database\Seeders;

use App\Enums\UserRole;
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

        $MASTER_NAME = 'Master Company';
        $company = \App\Models\Company::where('name', $MASTER_NAME)->first();

        if($company)
        {
            \App\Models\User::create([
                'name' => 'Master User',
                'email' => 'master@email.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'company_id' => $company->id,
                'role' => 0
            ]);
        }

        $companies = \App\Models\Company::all()->where('name', '!=', $MASTER_NAME);

        foreach ($companies as $company)
        {
            \App\Models\User::factory()->create([
                'company_id' => $company->id,
                'role' => UserRole::ADMIN
            ]);
        }
    }
}
