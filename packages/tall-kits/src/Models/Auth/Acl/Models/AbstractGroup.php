<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Tall\Kits\Models\Auth\Acl\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tall\Kits\Models\AbstractModel;

class AbstractGroup extends AbstractModel
{
    use HasFactory;

    protected $guarded = ['id'];
}
