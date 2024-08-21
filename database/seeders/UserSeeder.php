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

        if ($company) {
            $master_user = \App\Models\User::create([
                'name' => 'Master User',
                'email' => 'master@email.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'company_id' => $company->id,
                'role' => UserRole::MASTER
            ]);

            \App\Models\Profile::factory()->create([
                'user_id' => $master_user->id
            ]);
        }

        $companies = \App\Models\Company::all()->where('name', '!=', $MASTER_NAME);

        foreach ($companies as $company) {
            $user = \App\Models\User::factory()->create([
                'company_id' => $company->id,
                'role' => UserRole::ADMIN
            ]);

            \App\Models\Profile::factory()->create([
                'user_id' => $user->id
            ]);
        }
    }
}
