<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\CompanyResource;
use Illuminate\Support\Str;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

/*

TODO => store company logo / image

*/

class CompanyController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Company::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $companies = Company::all();

        return CompanyResource::collection($companies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        $data = $request->validated();
        $company = Company::create($data);

        User::create([
            'name' => 'admin-' . Str::slug($company->name),
            'email' => 'admin@' . Str::slug($company->name) . '.com',
            'password' => \bcrypt('admin123'),
            'company_id' => $company->id,
            'role' => UserRole::ADMIN
        ]);

        return new CompanyResource($company);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        $company->load(['users', 'vehicles']);

        return new CompanyResource($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $data = $request->validated();
        $updated_company = $company->update($data);

        return new CompanyResource($updated_company);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {

        $company->update(['active' => false]);

        return response()->noContent();
    }
}
