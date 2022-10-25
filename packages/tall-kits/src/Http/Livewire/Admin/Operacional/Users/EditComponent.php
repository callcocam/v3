<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Kits\Http\Livewire\Admin\Operacional\Users;

use App\Models\User;
use Tall\Kits\Core\Form\Field;
use Tall\Kits\Core\Form\FormComponent;

class EditComponent extends FormComponent
{

    public function mount(User $model)
    {

        $this->setFormProperties($model);
    }

    public function fields()
    {
        return [
            Field::avatar('Avatar','profile_photo_path','profile_photo_url'),
            Field::make('Name')->span('4'),
            Field::email('Email Address')->span('4'),
            Field::make('document')->span('4')->documentMask(),
            Field::money('money')->span('4'),
            Field::phone('phone')->span('4'),
            Field::make('profile')->span('4'),
            Field::radio('Genero','genger', ['male','female','other'])
            ->span('6'),
            Field::date('created_at'),
            Field::date('updated_at'),
        ];
    }

    protected function view()
    {
        return 'admin.operacional.users.edit';
    }
    
    /**
     * @return string
     */
    protected function prefix()
    {
        return config('tall.hint', "tall::");
    }
}
