<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\CompanyResource;
use Illuminate\Support\Str;
use App\Models\Company;
use App\Models\User;
use Exception;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
            'role' => 1 // admin
        ]);

        return new CompanyResource($company);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        try{
            return response()->json(['data' => $company ], 200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        try{
            $data = $request->validated();
            $company->update($data);

            return response()->json(['success' => 'Company data successfully updated' ], 200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        try{
            $company->delete();
            return response()->json(['success' => "Company " . $company->name." successfully removed" ], 200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
