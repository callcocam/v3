<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Kits\Http\Livewire;

use Livewire\Component;

abstract class AbstractComponent extends Component
{

    
    public $show_menu = true;

    abstract protected function view();

    protected function data(){

    }

    protected function layoutData(){

        return ['show_menu'=>$this->show_menu];

    }

    protected function modelName()
    {
        return class_basename($this->model);
    }
    
    /**
     * @return string
     */
    protected function layout()
    {
        return config('tall.layout', config( "livewire.layout"));
    }
    /**
     * @return string
     */
    protected function prefix()
    {
        return "";
    }

    public function render()
    {
        return view(sprintf("%slivewire.%s-component", $this->prefix(), $this->view()))
        ->with($this->data())
        ->layout( $this->layout(), $this->layoutData());
    }
}
