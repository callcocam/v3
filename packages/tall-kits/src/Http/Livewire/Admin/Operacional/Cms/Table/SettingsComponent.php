<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Kits\Http\Livewire\Admin\Operacional\Cms\Table;

use Illuminate\Support\Str;
use Livewire\Component;
use Tall\Kits\Models\TableConfig;
use Tall\Schema\Schema;
class SettingsComponent extends Component
{

    public $model;
    public $modelColumn;
    public $table;
    public $form_data=[];
    public $selecteds=[];
    public $activeSettingsTab = 'tabColumns';
    public $showSettings = false;
 
    protected $listeners = ['loadCongig'=>'$refresh'];
    
    public function mount(TableConfig $tableConfig)
    {
        $this->table = $tableConfig->table_name;
        $this->setFormProperties($tableConfig );
    }

    /**
     * @param null $model
     */
    protected function setFormProperties($model = null)
    {
        $this->model = $model;

        $this->selecteds  = data_get($model, 'selecteds');

    }

    public function updatedSelecteds($value)
    {
        if($this->selecteds){
            foreach($this->selecteds as $key => $name){
                if( !$this->model->configs()->where([
                    'id'=>$name
                ])->first()){
                    if($name){
                        $this->modelColumn = $this->model->configs()->firstOrCreate([
                            'alias'=>$key,
                            'name'=>$key,
                            'text'=>Str::title($key),
                        ]); 
                        $this->form_data  = $this->modelColumn->toArray();
                        $this->emit('loadCongig');
                        $this->activeSettingsTab = 'tabColumnDetail';
                    }else{
                       
                        if($model = $this->model->configs()->where('name',$key)){
                            $model->delete();
                        }
                    }
                   
                }else{
                    if(!data_get($this->selecteds, $key)){
                        if($model = $this->model->configs()->where('name',$key)){
                            unset($this->selecteds[$key]);
                            $model->delete();
                            $this->emit('loadCongig');
                        }
                    }
                }
            }
        }
    }
    public function getColumnsProperty()
    {
        return Schema::make()->getTable($this->table)->getColumns()->toArray();
    }

    /**
     * @param null $model
     */
    public function showSetting($show)
    {
       $this->showSettings = $show;
       $this->activeSettingsTab = 'tabColumns';
    }

    /**
     * @param null $model
     */
    public function setActiveSettingsTab($column, $tab='tabColumnDetail')
    {
        if($model = $this->model->configs()->where('name',$column)->first()){
            $this->modelColumn  = $model;
            $this->form_data  = $model->toArray();
        }
       $this->activeSettingsTab = $tab;
    }

    /**
     * @param null $model
     */
    public function save()
    {
        $this->activeSettingsTab = 'tabColumns';
        if($model = $this->modelColumn){
            $model->fill($this->form_data);
            $model->save();
            $this->emit('loadCongig');
        }
    }
    /**
     * @param null $model
     */
    public function delete()
    {
       $this->activeSettingsTab = 'tabColumns';
        if($model = $this->modelColumn){
            $model->delete();
            unset($this->selecteds[$model->name]);
            $this->emit('loadCongig');
        }
    }

   public function getLoadTableComponentsProperty()
    {
        return load_table_components();
    }

    public function groupUpdatedOrder($data)
    {
        $orders = explode("|", $data);
        $orders = array_filter($orders);
        if($orders){
            foreach($orders as $index => $id){
                if($model = $this->model->configs()->where('id',$id)->first()){
                    $model->ordering = $index;
                    $model->update();
                }
            }
            $this->setFormProperties($this->model );
            $this->emit('loadCongig');
        }
    }

    public function render()
    {
        return view('tall::livewire.admin.operacional.cms.table.settings-component');
    }

}
