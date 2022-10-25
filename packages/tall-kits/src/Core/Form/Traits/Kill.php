<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Kits\Core\Form\Traits;

trait Kill
{
    public function kill($params =[]){

        $this->model->delete();

        // flash("Operação realizada com sucesso :)", 'success')->dismissable();

        return redirect()->route($this->route, array_merge(request()->query(), $params));
    }
}
