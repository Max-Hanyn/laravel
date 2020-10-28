<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // define a admin user role
        Gate::define('isAdmin', function($user) {
            return $user->roles->pluck('name')->contains('admin');
        });

        //define a author user role
        Gate::define('isModerator', function($user) {
            return $user->roles->pluck('name')->contains('moderator');
        });

        // define a editor role
        Gate::define('isUser', function($user) {
            return $user->roles->pluck('name')->contains('user');
        });
        Gate::define('currentUserProfile', function($user,$id) {

            if($user->id == $id || $user->roles->pluck('name')->contains('admin') ||  $user->roles->pluck('name')->contains('moderator')){
                return true;
            } else{
                return false;
            }
        });
    }
}
