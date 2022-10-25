<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Kits\Core\Form\Traits;

trait Attributes
{

    public $readonly = false;
    /**
     * @param $class
     * @return $this
     */
    public function class($class)
    {

        $this->attribute('class', $class);
        return $this;
    }
    /**
     * @return $this
     */
    public function multiple()
    {

        $this->attribute('multiple', true);
        return $this;
    }

    /**
     * @return $this
     */
    public function readonly()
    {

        $this->readonly = true;

        $this->attribute('readonly', true);
        
        return $this;
    }

    /**
     * @return $this
     */
    public function disabled()
    {

        $this->attribute('disabled', true);
        return $this;
    }
    
    /**
     * @param $placeholder
     * @return $this
     */
    public function placeholder($placeholder)
    {
        $this->attribute('placeholder', $placeholder);
        return $this;
    }

    /**
     * @param $callback
     * @param $maks
     * @return $this
     */
    public function documentMask($callback="helpers.documentMask", $maks=null)
    {
        $this->attribute('x-mask:dynamic', $callback);
        if($maks){
            if(is_string($maks)){
                 $this->placeholder($maks);
            }
        }
        return $this;
    }
}
