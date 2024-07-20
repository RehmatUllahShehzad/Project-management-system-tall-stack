<?php

namespace App\Providers;


use App\Http\Middleware\Admin\Authenticate;
use App\Http\Middleware\RedirectIfAdminAuthenticated;
use Illuminate\Support\Facades\Gate;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Livewire\Livewire;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        $this->registerGates();

        $this->registerAuthMiddlewareForLivewireRoutes();

        //
    }

    public function registerGates()
    {
        Gate::after(function ($user, $ability) {
            // Are we trying to authorize something within the hub?
            // $permission = PermissionProviderService::make()->getCachedPermissions()->first( fn ($permission) => $permission->name === $ability );
            // if ($permission) {
            //     return $user->is_admin || $user->authorize($ability);
            // }

            return $user->is_admin;
        });
    }

    private function registerAuthMiddlewareForLivewireRoutes()
    {
        Livewire::addPersistentMiddleware([
            RedirectIfAdminAuthenticated::class,
            Authenticate::class,
            PermissionMiddleware::class,
        ]);
    }

}
