<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Resources\StandardResource;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class AuthController extends Controller
{
    use AuthorizesRequests;

    public function register(AuthRegisterRequest $request)
    {
        $company_query = \App\Models\Company::query();
        $user = $request->user();

        if (!$request->has('company')) // api/register?company={company_id}
        {
            throw new BadRequestHttpException('Missing required company parameter');
        }

        $company = $company_query->where('id', $request->query('company'))->firstOrFail();
        $this->authorize('admin-action', $company); // if the current user and the new user are from the same company  and is the admin allow user creation

        $selected_company = $user->isMaster() ? $company : $user->company;

        $user = User::create([
            ...$request->validated(),
            'company_id' => $selected_company->id
        ]);

        $user->profile()->create($request->getUserMeta());

        return new StandardResource($user);
    }

    public function login(AuthLoginRequest $request)
    {
        $request->validated();

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'message' => 'invalid credentials'
            ]);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $user->load('company');
        $token = $user->createToken($user->name)->plainTextToken;

        return new StandardResource([
            'accessToken' => $token,
            'tokenType' => 'Bearer',
            'user' => $user
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        Auth::logout();
        return response()->noContent();
    }
}
