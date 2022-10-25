<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tall\Kits\Models\AbstractModel;

class Comment extends AbstractModel
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    
    /**
    * @return string
    */
    protected function slugTo()
    {
        return false;
    }
}
