<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Kits\Http\Livewire\Includes\Partials;;

use Livewire\Component;

abstract class AbstractComponent extends Component
{
    
    public $routePrefix;
    
   abstract public function view();

    public function render()
    {
        return view(sprintf("tall::livewire.%s-component", $this->view()));
    }
}
