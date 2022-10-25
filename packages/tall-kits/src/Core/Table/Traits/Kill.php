<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Kits\Core\Table\Traits;


trait Kill
{
    protected $confirming;

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }
    public function close()
    {

        $this->confirming = null;
    }

    public function kill($id)
    {
        try {
            $this->query()->find($id)->delete();
            $this->confirming = null;
            return ;
        }catch (\PDOException $exception){
            $this->confirming = null;
        }
    }

    public function getConfirmingProperty(){
        return $this->confirming;
    }

    public function deleteKill($route,$params){

        $this->model->delete();

        //$this->dispatchBrowserEvent('closeModalForm');

        return redirect()->route($route, array_merge(request()->query(), json_decode($params, true)));
    }

    public function deleteModel(){

        try {
           if($this->deleteChildren($this->currentDelete)){
                $this->currentDelete->delete();                
                $this->dispatchBrowserEvent('closeModalForm', 'openPanelRightDelete');
               // flash('Operação realizada com sucesso :)', 'success')->dismissable()->livewire($this);            
                return ;
           }           
           $this->dispatchBrowserEvent('closeModalForm', 'openPanelRightDelete');
          // flash("Ouve um erro, não foi possivel realizar a operação, é provavel que exista registros relacionados", 'danger')->dismissable()->livewire($this);
        }catch (\PDOException $exception){
            $this->dispatchBrowserEvent('closeModalForm', 'openPanelRightDelete');
            if($this->user()->isAdmin()){
                //flash($exception->getMessage(), 'success')->dismissable()->livewire($this);
            }
            else{
              //  flash("Ouve um erro, não foi possivel realizar a operação, é provavel que exista registros relacionados", 'success')->dismissable()->livewire($this);
            }
        }

    }

    public function deleteChildren($model)
    {
        return true;
    }
}
