<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return Gate::allows('is-company-member', $user->company) && $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $targetUser): bool
    {
        return Gate::allows('admin-action', $targetUser->company) || $user->id === $targetUser->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $targetUser): bool
    {
        return $user->id === $targetUser->id;
    }

    public function delete(User $user, User $targetUser): bool
    {
        return Gate::allows('is-company-member', $user->company)
                    && $user->isAdmin()
                    && $user->id !== $targetUser->id;
    }
}
