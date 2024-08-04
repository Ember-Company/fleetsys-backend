<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\CompanyResource;
use Illuminate\Support\Str;
use App\Models\Company;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Company::class);
    }

    /**
     *
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Nao precisa try-catch, fiz um Exception Handler global pra resource not found, caso tiver um collection vazio o frontend vai tratar
        $companies = Company::with('users')->get();

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
            'name' => 'admin-' . $company->name,
            'email' => 'admin@' . Str::lower($company->name) . '.com',
            'password' => 'admin123',
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
        $company->load(['user']);

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
        // switch to soft delete, cascadeOnDelete to soft delete it's users
        $company->delete();

        return response()->noContent();
    }
}
