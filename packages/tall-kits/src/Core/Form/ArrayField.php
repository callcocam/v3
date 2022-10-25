<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Kits\Core\Form;


use Tall\Kits\Core\Form\Traits\Attributes;

class ArrayField extends BaseField
{

    use Attributes;

    public $wire_model = ".defer";

    protected $column_width;

    /**
     * ArrayField constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->view("text");
        $this->name = $name;
    }

    /**
     * @param $name
     * @return static
     */
    public static function make($name)
    {
        return new static($name);
    }

    /**
     * @param $width
     * @return $this
     */
    public function columnWidth($width)
    {
        $this->column_width = $width;
        return $this;
    }
}
