<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tall\Kits\Models\AbstractModel;
use Tall\Kits\Models\Concerns\HasCoverPhoto;

class Post extends AbstractModel
{
    use HasFactory, HasCoverPhoto;

    protected $guarded = ['id'];
    protected $appends = ['cover_photo_url'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
