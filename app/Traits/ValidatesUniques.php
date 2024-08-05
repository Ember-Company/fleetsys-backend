<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

trait ValidatesUniques
{

    /**
     * Get a unique validation rule with company ID constraint.
     *
     * @param  string  $table
     * @param  string  $column
     * @return \Illuminate\Validation\Rules\Unique
     */
    public function uniqueWithCompany(string $table, string $column): Unique
    {
        $company = Auth::user()->company;

        return Rule::unique($table, $column)->where(function ($query) use ($company) {
            return $query->where('company_id', $company->id);
        })->ignore(null);
    }

}
