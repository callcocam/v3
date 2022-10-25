<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Kits\Core\Form\Http\Livewire\Fields;


use Livewire\Component;
use Livewire\WithFileUploads;
// use Spatie\Image\Image;

class Cover extends Component
{

    use WithFileUploads;

    public $cover;
    public $name;
    public $x;
    public $y;
    public $width;
    public $height;

    public function mount($cover, $name)
    {

        $this->setFormProperties($cover, $name);
    }

    public function render()
    {
        return view('laravel-livewire-forms::fields.livewire.cover');
    }

    // public function save($cover, $name)
    // {
    //     Image::load(storage_path('app/public/' . $cover))
    //         ->manualCrop($this->width, $this->height, $this->x, $this->y)
    //         ->save();

    //     $this->emit('fileUpdate', [
    //         'cover' => $cover,
    //         'name' => $name,
    //     ]);

    //     $this->cover = null;
    //     $this->name = null;
    // }

    public function cancel($cover, $name)
    {
        $this->emit('fileUpdate', [
            'cover' => config("laravel-livewire-forms.default-no-image"),
            'name' => $name,
        ]);
        $this->cover = null;
        $this->name = null;
    }

    /**
     * @param null $field
     */
    public function setFormProperties($cover, $name)
    {
        $this->cover = $cover->store('avatars', 'public');
        $this->name = $name;

    }

}
