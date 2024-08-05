<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $user_meta = request()->input('user_meta');

        if ($user_meta)
        {
            $user->profile()->create($user_meta);
        }
    }
}
