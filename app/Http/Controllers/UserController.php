<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\StandardResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use AuthorizesRequests, HasEvents;

    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $company = $request->user()->company;
        $users = User::with(['company', 'profile'])
                        ->whereBelongsTo($company)
                        ->latest()
                        ->paginate(10);

        return StandardResource::collection($users);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load(['company', 'profile']);

        return new StandardResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update([
            ...$request->validated()
        ]);

        $user->profile()->update($request->getUserMeta());

        $user->load(['profile']);
        return new StandardResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->deleteOrFail();

        return response()->noContent();
    }
}
