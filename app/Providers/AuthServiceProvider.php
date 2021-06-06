<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Administrator
        Gate::define('administration', function($user){
            return $user->hasRole(['Administrator']);
        });

        // Role manage
        Gate::define('roleManage', function($user){
            return $user->hasAnyRoles(['Administrator', 'Role-manage']);
        });

        // Admin-manage
        Gate::define('adminManage', function($user){
            return $user->hasAnyRoles(['Administrator', 'Admin-manage']);
        });


        //Add Access
        Gate::define('add', function($user){
            return $user->hasAnyRoles(['Administrator', 'Add']);
        });

        //Edit Access
        Gate::define('edit', function($user){
            return $user->hasAnyRoles(['Administrator', 'Edit']);
        });

        //Delete
        Gate::define('delete', function($user){
            return $user->hasAnyRoles(['Administrator', 'Delete']);
        });

        //Delete
        Gate::define('delete', function($user){
            return $user->hasAnyRoles(['Administrator', 'Delete']);
        });

        //About
        Gate::define('about', function($user){
            return $user->hasAnyRoles(['Administrator', 'About']);
        });

        //News
        Gate::define('news', function($user){
            return $user->hasAnyRoles(['Administrator', 'News']);
        });

        //Business
        Gate::define('business', function($user){
            return $user->hasAnyRoles(['Administrator', 'Business']);
        });

        //Setting
        Gate::define('setting', function($user){
            return $user->hasAnyRoles(['Administrator', 'Setting']);
        });

    }
}
