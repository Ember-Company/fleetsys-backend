<?php

namespace App\Listeners;

use App\Events\LoggedIn;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateCompanyActivity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LoggedIn $event): void
    {
        $user = $event->user;
        $company = $user->company;

        if ($company->last_active_at === null || $company->last_active_at->lt(now()->subMinutes(5))) {
            $company->update([
                'last_active_at' => now()
            ]);
        }
    }
}
