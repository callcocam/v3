<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Http\Livewire\Admin\Posts;

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Tall\Kits\Core\Form\FormComponent;

class EditComponent extends FormComponent
{
    
    public function route()
    {
        Route::get("post/{model}/edit", static::class)->name('admin.post.edit');
    }
    
    public function mount(Post $model)
    {
        $this->setFormProperties($model);
    }
    public function view()
    {
        return 'admin.posts.edit';
    }
}
