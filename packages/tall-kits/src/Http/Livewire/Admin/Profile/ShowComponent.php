<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Kits\Http\Livewire\Admin\Profile;

use Tall\Kits\Core\Form\Field;
use Tall\Kits\Core\Form\FormComponent;

class ShowComponent extends FormComponent
{

    public function mount()
    {
        $this->setFormProperties($this->user());
    }

    public function fields()
    {
        return [
            Field::avatar('Avatar','profile_photo_path','profile_photo_url'),
            Field::make('Name')->span('6'),
            Field::email('Email Address')->span('6'),
            Field::phone('phone')->span('6'),
        ];
    }

    protected function view()
    {
        return 'admin.profile.show';
    }
    /**
     * @return string
     */
    protected function prefix()
    {
        return config('tall.hint', "tall::");
    }
}
