<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Kits\Console\Commands;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Livewire\Commands\ComponentParser as CommandsComponentParser;

use function Livewire\str;

class ComponentParser extends CommandsComponentParser
{
    
    public function component()
    {
        return $this->component;
    }

    public function classPath()
    {
        return $this->baseClassPath.collect()
            ->concat($this->directories)
            ->push($this->classFile())
            ->implode('/');
    }

    public function relativeClassPath() : string
    {
       
        return str($this->classPath())->replaceFirst(__DIR__.DIRECTORY_SEPARATOR, '');
    }

    public function classFile()
    {
        return $this->componentClass.'.php';
    }

    public function classNamespace()
    {
        return empty($this->directories)
            ? $this->baseClassNamespace
            : $this->baseClassNamespace.'\\'.collect()
                ->concat($this->directories)
                ->map([Str::class, 'studly'])
                ->implode('\\');
    }

    public function className()
    {
        return $this->componentClass;
    }

    public function viewPath()
    {
        return $this->baseViewPath.collect()
            ->concat($this->directories)
            ->map([Str::class, 'kebab'])
            ->push($this->viewFile())
            ->implode(DIRECTORY_SEPARATOR);
    }


    public function viewFile()
    {
        return $this->component.'.blade.php';
    }

    public function viewName()
    {
        $viewName= collect()
            ->when(config('livewire.view_path') != resource_path(), function ($collection) {
                return $collection->concat(explode('/',str($this->baseViewPath)->after(resource_path('views'))));
            })
            ->filter()
            ->concat($this->directories)
            ->map([Str::class, 'kebab'])
            ->push($this->component)
            ->implode('.');

            $viewName = Str::afterLast($viewName, '.resources.views.livewire.');
            $viewName = Str::beforeLast($viewName, '-component');
            return $viewName;

    }
    
    public static function generatePathFromNamespace($namespace)
    {
        $name = str($namespace)->finish('\\')->replaceFirst('Tall\\Kits\\', '');
       
        return __DIR__.'/../../'.str_replace('\\', '/', $name);
    }

}
