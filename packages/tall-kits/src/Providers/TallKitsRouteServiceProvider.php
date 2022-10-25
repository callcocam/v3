<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Kits\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;

class TallKitsRouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
       

        $this->routes(function () {
           $middleware= [
            'web',
            'auth:sanctum',
            config('jetstream.auth_session'),
            'verified'
           ];
            Route::middleware('api')
                ->prefix('api')
                ->group(function(){
                    
                });

            Route::middleware($middleware)
            ->prefix('admin')
                ->group(function(){
                  Route::get("/",\Tall\Kits\Http\Livewire\Admin\DashboardComponent::class)->name('admin');
                  Route::get("/minha-conta",\Tall\Kits\Http\Livewire\Admin\Profile\ShowComponent::class)->name('admin.profile.show');
                  Route::get("/users",\Tall\Kits\Http\Livewire\Admin\Operacional\Users\ListComponent::class)->name('admin.users');
                  Route::get("/user/{model}/editar",\Tall\Kits\Http\Livewire\Admin\Operacional\Users\EditComponent::class)->name('admin.user.edit');
                });

            Route::middleware($middleware)
            ->prefix('admin')->group( function(){
                if(is_dir(app_path('Http/Livewire/Admin'))){
                    configureDynamicRoute(app_path('Http/Livewire/Admin'));
                }
            });
                
        });
    }
 
}
