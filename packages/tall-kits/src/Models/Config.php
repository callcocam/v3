<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Kits\Models;

use Tall\Kits\Models\Concerns\Column;

class Config extends AbstractModel
{
    use Column;
    
    protected $guarded = ['id'];
    /**
     * Get the parent configable model (form or table).
     */
    public function configable()
    {
        return $this->morphTo();
    }
}
