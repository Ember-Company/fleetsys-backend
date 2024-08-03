<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class AuthController extends Controller
{
    use AuthorizesRequests;

    public function register(Request $request)
    {
        $company_query = \App\Models\Company::query();

        if (!$request->has('company')) // api/register?company={company_id}
        {
            throw new BadRequestHttpException('Missing required company parameter');
        }

        $company = $company_query->where('id', $request->query('company'))->first();
        $this->authorize('is-member', $company); // if the current user and the new user are from the same company allow user creation

        $user = User::create([
            ...$request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:8',
            ]),
            'company_id' => $request->user()->company->id
        ]);

        return response()->json([
            'user' => $user
        ], 200);

        // $token = $user->createToken($request->name)->plainTextToken;
        // return response()->json(['access_token' => $token,'token_type' => 'Bearer', 'user' => $user], 200);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
            'message' => 'Invalid login details'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->noContent();
    }
}
