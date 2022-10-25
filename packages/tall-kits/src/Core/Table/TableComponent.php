<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Kits\Core\Table;

use Carbon\Carbon as CarbonCarbon;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\{Str, Arr};
use Illuminate\Support\Facades\Route;
use Livewire\WithPagination;
use Tall\Kits\Core\Table\Traits\Pagination;
use Tall\Kits\Core\Table\Traits\Relationship;
use Tall\Kits\Core\Table\Traits\Search;
use Tall\Kits\Core\Table\Traits\Sorting;
use Tall\Kits\Http\Livewire\AbstractComponent;
use Tall\Kits\Models\TableConfig;

abstract class TableComponent extends AbstractComponent
{
    use AuthorizesRequests,Pagination,Sorting, Search,Relationship, WithPagination;

    public $currentRouteName;
    public $table;
    public $filters =  [];
    public $tableConfig;
 
    protected $listeners = ['loadCongig'];

    protected $queryString = [
        'filters' => ['except' => []],
        'page' => ['except' => 1],
    ];

    protected $paginationTheme = 'card';

    public function mount()
    {
        $this->currentRouteName = Route::currentRouteName();
        $this->authorize($this->currentRouteName);
        session()->put('back',Route::currentRouteName());
    }
 
    public function loadCongig($data=[])
    {
        # code...
    }
    /**
     * @var mixed
     */
    protected function tableAttr(): array
    {
      
        return [
            'title'=>$this->modelName()
        ];
    }

    protected function modelName()
    {
        return class_basename($this->query()->getModel());
    }

    public function columns(){

        if($tableConfig = $this->tableConfig->configs){
            return $tableConfig;
        }
        return [];
    }
    
    /**
     * @return Builder
     */
    protected function query()
    {
        //
    }
    
    /**
     * @return Builder
     */
    protected function getTableConfig()
    {
    
        if(empty( $this->table)){
            $this->table = $this->query()->getModel()->getTable();
        }

        $this->tableConfig = TableConfig::query()->firstOrCreate([
            'name'=>$this->currentRouteName,
            'table_name'=>$this->table
        ]);
        return $this->tableConfig;
    }

    protected function data(){
        return [
            'tableConfig'=>$this->getTableConfig(),
            'tableAttr'=>$this->tableAttr(),
            'models'=>$this->models(),
            'columns'=>$this->columns(),
        ];
    }

    /**
     * @return Builder
     */
    public function models()
    {
        if ( $builder = $this->query()) {
            $builder->where(function (Builder $builder) {
                foreach ($this->columns() as $column) {
                    if ($column->isSearchable()) {
                        if (Str::contains($column->name, '.')) {
                            $relationship = $this->relationship($column->name);

                            $builder->orWhereHas($relationship->name, function (Builder $query) use ($relationship) {
                                $query->where($relationship->name, 'like', '%' . data_get($this->filters, 'search') . '%');
                            });
                        } elseif (Str::endsWith($column->name, '_count')) {
                            // No clean way of using having() with pagination aggregation, do not search counts for now.
                            // If you read this and have a good solution, feel free to submit a PR :P
                        } else {
                            $builder->orWhere($builder->getModel()->getTable() . '.' . $column->name, 'like', '%' . trim(data_get($this->filters, 'search')) . '%');
                        }


                    }
                }
            });
            if ($range = data_get($this->filters ,'range')){
                $start = Str::beforeLast($range, ' ');
                $end = Str::afterLast($range, ' ');
                $builder->whereBetween($this->data_field, [CarbonCarbon::parse($start)->format('Y-m-d'), CarbonCarbon::parse($end)->format('Y-m-d')]);                   
            }
    
            if ($status = data_get($this->filters ,'status')){
                $builder->whereIn('status', [$status]);                   
            }
            return $this->appendGuery($builder)->orderBy($this->getSortField(), $this->direction)->paginate(data_get($this->filters ,'perPage'));

        }
        return null;   
       
    }

    public function appendGuery($builder)
    {
        return $builder;
    }

    public function updatedFilters($data)
    {
       foreach($this->filters as $key => $value){
            if(empty($value)){
                unset($this->filters[$key]);
            }
       }
    }
}
