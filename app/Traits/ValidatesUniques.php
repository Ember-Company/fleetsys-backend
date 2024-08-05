<?php

namespace App\Traits;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

trait ValidatesUniques
{

    /**
     * Get a unique validation rule with company ID constraint.
     *
     * @param  string  $table
     * @param  string  $column
     * @param  \App\Models\Company $company
     * @return \Illuminate\Validation\Rules\Unique
     */
    public function uniqueWithCompany(string $table, string $column, \App\Models\Company $company): Unique
    {
        return Rule::unique($table, $column, $company)->where(function ($query) use ($company) {
            return $query->where('company_id', $company->id);
        })->ignore(null);
    }

}
