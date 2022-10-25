<?php

namespace App\Http\Livewire\Admin\Posts;

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Tall\Kits\Core\Table\TableComponent;

class ListComponent extends TableComponent
{

    public function route()
    {
        Route::get("posts", static::class)->name('admin.posts');
    }
     /**
     * @return string
     */
    protected function prefix()
    {
        return "";
    }

    public function query()
    {
        return Post::query();
    }

    public function view()
    {
        return 'admin.posts.list';
    }
}
