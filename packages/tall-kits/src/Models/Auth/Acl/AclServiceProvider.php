<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Kits\Models\Auth\Acl;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Access\Authorizable;


class AclServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return null
     */
    public function boot()
    {
        $this->publishConfig();
        $this->publishMigrations();
        $this->loadMigrations();

        $this->registerGates();
        $this->registerBladeDirectives();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/acl.php', 'acl'
        );

        $this->app->singleton('acl', function ($app) {
            $auth = $app->make('Illuminate\Contracts\Auth\Guard');

            return new  Acl($auth);
        });
    }

    /**
     * Register the permission gates.
     *
     * @return void
     */
    protected function registerGates()
    {
        Gate::before(function(User $user, $permission) {
            try {
                if (method_exists($user, 'hasPermissionTo')) {
                    return $user->hasPermissionTo($permission) ?: null;
                }
            } catch (Exception $e) {
            }
        });
    }

    /**
     * Register the blade directives.
     *
     * @return void
     */
    protected function registerBladeDirectives()
    {
        Blade::if('role', function($role) {  
            /* intelephense-disable */
            return auth()->user() and auth()->user()->hasRole($role);
            /* intelephense-enable */
        });

        Blade::if('anyrole', function(...$roles) {
              /* intelephense-disable */
            return auth()->user() and auth()->user()->hasAnyRole(...$roles);
            /* intelephense-enable */
        });

        Blade::if('allroles', function(...$roles) {
            /* intelephense-disable */
            return auth()->user() and auth()->user()->hasAllRoles(...$roles);
            /* intelephense-enable */
        });
    }

    /**
     * Publish the config file.
     *
     * @return void
     */
    protected function publishConfig()
    {
        $this->publishes([
            __DIR__.'/config/acl.php' => config_path('acl.php'),
        ], 'config');
    }

    /**
     * Publish the migration files.
     *
     * @return void
     */
    protected function publishMigrations()
    {
        $this->publishes([
            __DIR__.'/migrations/' => database_path('migrations/landlord'),
        ], 'acl-migrations');
    }

    /**
     * Load our migration files.
     *
     * @return void
     */
    protected function loadMigrations()
    {
        if (config('acl.migrate', false)) {
            $this->loadMigrationsFrom(__DIR__.'/migrations');
        }
    }
}
