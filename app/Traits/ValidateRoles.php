<?php

namespace App\Traits;

use App\Models\User;

trait ValidateRoles
{
   /**
     * Get a validation rule that ensures the user is not an admin.
     *
     * @return \Closure
     */
    public function notAdminUserRule(): \Closure
    {
        return function ($attribute, $value, $fail) {
            $user = User::find($value);
    
            if ($user === null || $user->isAdmin() || $user->isMaster()) {
                $fail('The selected user is invalid or cannot be an admin or master.');
            }
        };
    }
}
