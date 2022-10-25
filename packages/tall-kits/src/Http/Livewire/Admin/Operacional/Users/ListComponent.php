<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Kits\Http\Livewire\Admin\Operacional\Users;

use App\Models\User;
use Tall\Kits\Core\Table\TableComponent;

class ListComponent extends TableComponent
{


    protected function query()
    {
        return User::query();
    }
    
    // public function columns()
    // {
    //     return [
    //         Column::make('Name')->searchable()
    //     ];
    // }

    protected function view()
    {
        return 'admin.operacional.users.list';
    }
    /**
     * @return string
     */
    protected function prefix()
    {
        return config('tall.hint', "tall::");
    }
}
