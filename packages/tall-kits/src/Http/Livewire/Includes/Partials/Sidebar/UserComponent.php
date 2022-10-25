<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Kits\Http\Livewire\Includes\Partials\Sidebar;

use App\Models\User;
use Tall\Kits\Http\Livewire\Includes\Partials\AbstractComponent;

class UserComponent extends AbstractComponent
{
    public $user;

    public function mount(User $user)
    {
       $this->user = $user;
    }
    public function view()
    {
        return 'includes.partials.sidebar.user';
    }
}
