<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Kits\Core\Form\Facades;


use Illuminate\Support\Facades\Facade;
use Tall\Kits\Core\Form\Field as FormField;

class Field extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return  FormField::class;
    }
}
