<?php

namespace App\Traits;

use App\Models\Company;
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
     * @param  ?Company $company
     * @return \Illuminate\Validation\Rules\Unique
     */
    public function uniqueWithCompany(string $table, string $column, ?Company $company = null): Unique
    {
        $selected_company = $company ?? Auth::user()->company;

        return Rule::unique($table, $column)->where(function ($query) use ($selected_company) {
            return $query->where('company_id', $selected_company->id);
        })->ignore(null);
    }
}
