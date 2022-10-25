<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Kits\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Tall\Kits\Console\Commands\TallLivewireCommand;
use Tall\Kits\Http\Livewire\Admin\DashboardComponent;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Blade;
use Symfony\Component\Finder\Finder;
use Tall\Kits\Http\Livewire\Admin\Profile\DeleteUserForm;
use Tall\Kits\Http\Livewire\Admin\Profile\LogoutOtherBrowserSessionsForm;
use Tall\Kits\Http\Livewire\Admin\Profile\ShowComponent;
use Tall\Kits\Http\Livewire\Admin\Profile\TwoFactorAuthenticationForm;
use Tall\Kits\Http\Livewire\Admin\Profile\UpdatePasswordForm;
use Tall\Kits\Http\Livewire\Admin\Profile\UpdateProfileInformationForm;
use Tall\Kits\Http\Livewire\Includes\Partials\HeaderComponent;
use Tall\Kits\Http\Livewire\Includes\Partials\Mobile\SearchbarComponent;
use Tall\Kits\Http\Livewire\Includes\Partials\Sidebar\MainComponent;
use Tall\Kits\Http\Livewire\Includes\Partials\Sidebar\PanelComponent;
use Tall\Kits\Http\Livewire\Includes\Partials\Sidebar\RightComponent;
use Tall\Kits\Http\Livewire\Includes\Partials\Sidebar\UserComponent;
use Tall\Kits\Models\Auth\Acl\AclServiceProvider;

class TallKitsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->register(AclServiceProvider::class);
       $this->app->register(TallKitsRouteServiceProvider::class);

        // $this->app->bind('Field', Field::class);
        // $loader = AliasLoader::getInstance();
        // $loader->alias('Field', Field::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/tall.php','tall'
        );
        if ($this->app->runningInConsole()) {
            $this->commands([
                    TallLivewireCommand::class
                 ]);
         }
         
         $this->configureDynamicComponent(dirname(__DIR__,2));

         if (class_exists(Livewire::class)) {
            //SIDEBAR GLOBAL
            Livewire::component( 'tall::admin.dash-board-component', DashboardComponent::class);
            Livewire::component( 'tall::includes.partials.sidebar.main-component', MainComponent::class);
            Livewire::component( 'tall::includes.partials.sidebar.panel-component', PanelComponent::class);
            Livewire::component( 'tall::includes.partials.header-component', HeaderComponent::class);
            Livewire::component( 'tall::includes.partials.mobile.searchbar-component', SearchbarComponent::class);
            Livewire::component( 'tall::includes.partials.sidebar.right-component', RightComponent::class);
            Livewire::component( 'tall::includes.partials.sidebar.user-component', UserComponent::class);
            
            
            //PRFILE ADMIN
            Livewire::component( 'tall::admin.profile.show-component', ShowComponent::class);
            Livewire::component( 'tall::admin.profile.update-profile-information-form', UpdateProfileInformationForm::class);
            Livewire::component( 'tall::admin.profile.update-password-form', UpdatePasswordForm::class);
            Livewire::component( 'tall::admin.profile.two-factor-authentication-form', TwoFactorAuthenticationForm::class);
            Livewire::component( 'tall::admin.profile.logout-other-browser-sessions-form', LogoutOtherBrowserSessionsForm::class);
            Livewire::component( 'tall::admin.profile.delete-user-form', DeleteUserForm::class);
        
            //USER ADMIN
            Livewire::component("tall::admin.oreracional.list-component",\Tall\Kits\Http\Livewire\Admin\Operacional\Users\ListComponent::class);
            Livewire::component("tall::admin.oreracional.edit-component",\Tall\Kits\Http\Livewire\Admin\Operacional\Users\EditComponent::class);
            
            //TABLE SETTINGS
            Livewire::component("tall::admin.operacional.cms.table.settings-component",\Tall\Kits\Http\Livewire\Admin\Operacional\Cms\Table\SettingsComponent::class);

        }
         $this->publishViews();
    }

    
    private function publishViews(): void
    {
        $pathViews = __DIR__ . '/../../resources/views';
        $this->loadViewsFrom($pathViews, 'tall');
      //   Blade::anonymousComponentNamespace(__DIR__ . '/../../resources/views/components', 'tall');
        if(is_dir(resource_path('views/vendor/tall')))
        {
            $pathViews = resource_path('views/vendor/tall');
            $this->loadViewsFrom($pathViews, 'tall');
            // Blade::anonymousComponentNamespace(resource_path('views/vendor/tall/components'), 'tall');
        }
    }
 /**
     * Configure the component for the application.
     *
     * @return void
     */
    public function configureDynamicComponent($path,$search=".blade.php")
    {
       foreach ((new Finder)->in(sprintf("%s/resources/views/components", $path))->files()->name('*.blade.php') as $component) {                   
            $componentPath = $component->getRealPath();     
            $namespace = Str::beforeLast($componentPath, $search);
            $namespace = Str::afterLast($namespace, 'components/');
            $name = Str::replace(DIRECTORY_SEPARATOR,'.',$namespace);
            if(!Str::contains($namespace, 'tall/')){
                $this->loadComponent($name, $name);
            }
        }
    }
    
    public function loadComponent($component, $alias=null){
        if ($alias == null){
            $alias=$component;
        }
        Blade::component("tall::components.{$component}",'tall-'.$alias);
    }
    
}
