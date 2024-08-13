<?php

namespace App\Providers;
use App\Models\User;
use App\Policies\UserPolicy;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

// use Illuminate\Support\Facades\Log;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::before(function ($user, $ability) {
            // $currentTeamId = $user->getTeamIdAttribute() ?? null;

            if ($user->hasRole('Super Admin')) {
                // Log::error('Super admin is true');
                return true; // Bypass all other checks within the team context
                
            }
            // Log::error("Super admin is false, current team_id is $currentTeamId user_id is $user->id");
        });
    }
}
