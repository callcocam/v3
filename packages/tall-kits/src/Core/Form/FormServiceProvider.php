<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Form;


use App\SIGA\Form\Http\Livewire\Fields\Cover;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class FormServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            // $this->commands([MakeForm::class]);
        }

        $this->mergeConfigFrom(sprintf('%s/config/laravel-livewire-forms.php', __DIR__),'laravel-livewire-forms');
        $this->loadViewsFrom(sprintf('%s/resources/views', __DIR__), 'laravel-livewire-forms');
        $this->loadRoutesFrom(sprintf('%s/routes/form.php', __DIR__));

        Livewire::component('form-cover', Cover::class);
    }

    public function register()
    {

    }
}
