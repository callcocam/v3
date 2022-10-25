<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Kits\Models;


class TableConfig extends AbstractModel
{
    
    protected $guarded = ['id'];
    protected $append = ['selecteds'];
    protected $with = ['configs'];

       /**
     * Get the post's image.
     */
    public function configs()
    {
        return $this->morphMany(Config::class, 'configable')->orderBy('ordering');
    }

    public function getSelectedsAttribute()
    {
        return $this->configs()->pluck("id","name");
    }
}
