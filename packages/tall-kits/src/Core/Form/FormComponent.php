<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Kits\Core\Form;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Kits\Core\Form\Traits\Errors;
use Tall\Kits\Core\Form\Traits\Kill;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Livewire\WithFileUploads;
use Tall\Kits\Core\Form\Traits\FollowsRules;
use Tall\Kits\Core\Form\Traits\TraitLog;
use Tall\Kits\Core\Form\Traits\UploadsFiles;
use Tall\Kits\Http\Livewire\AbstractComponent;

abstract class FormComponent extends AbstractComponent
{

    use FollowsRules, Kill, Errors, WithFileUploads,UploadsFiles, TraitLog, AuthorizesRequests;

    public $model;
    public $form_data;
    //public $user;

    public $search;
    public $search_checkbox;
    

    /**
     * @var string[]
     */
    protected $listeners = ['fileUpdate', 'input','refreshPhoto'];

    /**
     * @var mixed
     */
    protected function formAttr(): array
    {
      
        return [
            'title'=>$this->modelName(),
            'description'=>$this->title(),
            'route'=>$this->back(session()->get('back')),
        ];
    }

    /**
     * @var mixed
     */

    protected function layout(): string
    {
        return "tall::layouts.app";
    }

    public function refreshPhoto($data)
    {

    }

    public function loadProdutoApi($data)
    {

    }

    public function fileUpdate($data)
    {
        $this->form_data[$data['name']] = $data['cover'];
    }

    public function input($data)
    {
        $this->form_data[$data['field']] = $data['value'];
    }

    protected function title()
    {
        if ($this->model->exists) {
            if (isset($this->form_data['name'])) {
                return sprintf('Editar %s', $this->form_data['name']);
            }

        }
        return "Cadastrar novo registro";
    }


    protected function backRoute()
    {
        return class_basename($this->model);
    }

    /**
     * @param null $model
     */
    protected function setFormProperties($model = null)
    {

        $this->authorize(Route::currentRouteName());
        
        //$this->user = $this->user();
        $this->model = $model;
        if ($model) {
            $this->form_data = $model->toArray();
        }
        foreach ($this->fields() as $field):
            if (!isset($this->form_data[$field->name])):
                $array = in_array($field->type, ['checkbox', 'file']);
                if (in_array($field->type, ['file'])) {
                    if ($this->form_data[$field->name] = data_get($model, $field->name)) {
                        $this->form_data[$field->alias] = data_get($model, $field->alias);
                        $this->form_data[$field->name] = data_get($model, $field->name)->file;
                    }
                } else {
                    $this->form_data[$field->name] = $field->default ?? ($array ? [] : null);
                }
            endif;
        endforeach;
    }


    /**
     * @return mixed
     */
    protected function data()
    {

        $fields = $this->elements();
        $fields['fields']= $fields;
        $fields['formAttr']= $this->formAttr();

        return $fields;
    }

    /**
     * @return string
     */
    // abstract public function formView();

    /**
     * @return array
     */
    protected function fields()
    {
        return [];
    }


    /**
     * @param $field
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updated($field)
    {
        if ($this->rules())
            $this->validateOnly($field, $this->rules());

        if(data_get($this->form_data, Str::afterLast($field, '.')) instanceof UploadedFile){
            // dd(data_get($this->form_data, Str::afterLast($field, '.')));
        }
    }

    public function submit()
    {
        if ($this->rules())
            $this->validate($this->rules());

        $field_names = [];
        foreach ($this->fields() as $field) $field_names[] = $field->name;
        $this->form_data = Arr::only($this->form_data, $field_names);
        if($this->uploadPhoto()){
            return $this->success();
        }
       return false;
    }

    protected function uploadPhoto()
    {
        foreach($this->fileUpload() as $field_name => $uploaded_files){
            $this->fileUploadate( $field_name, $uploaded_files);
        }

        return true;
    }


    protected function success()
    {
        
        if ($this->model->exists) {
            try {
                $this->model->update($this->form_data);
                if (Route::has($this->routeEdit())){
                    $this->dispatchBrowserEvent('notification', ['text' => 'Operação realizada com sucesso :)', 'variant'=>'success', 'time'=>3000, 'position'=>'right-top']);
                }
                else{
                    $this->dispatchBrowserEvent('closeModalForm', 'openPanelRightUpdate');
                    $this->emit('refreshUpdated', $this->model);
                    $this->dispatchBrowserEvent('notification', ['text' => 'Operação realizada com sucesso :)', 'variant'=>'success', 'time'=>3000, 'position'=>'right-top']);
                }
                return true;
            } catch (\PDOException $PDOException) {
                $this->dispatchBrowserEvent('notification', ['text' => $PDOException->getMessage(), 'variant'=>'error', 'time'=>3000, 'position'=>'right-top']);
                // flash($PDOException->getMessage(), 'danger')->dismissable()->livewire($this);
                return false;
            }
        } else {
                try {
                    $this->model = $this->model->create($this->form_data);
                    if (Route::has($this->routeCreate())){ 
                        $this->dispatchBrowserEvent('notification', ['text' => 'Operação realizada com sucesso :)', 'variant'=>'success', 'time'=>3000, 'position'=>'right-top']);
                        // flash('Operação realizada com sucesso :)', 'success')->dismissable()->livewire($this);
                    }
                    else{
                        $this->dispatchBrowserEvent('closeModalForm', 'openPanelRightCreate');
                        $this->emit('refreshCreate', $this->model);
                        $this->dispatchBrowserEvent('notification', ['text' => 'Operação realizada com sucesso :)', 'variant'=>'success', 'time'=>3000, 'position'=>'right-top']);
                        // flash('Operação realizada com sucesso :)', 'success')->dismissable()->livewire($this);
                    }
                    return true;
                } catch (\PDOException $PDOException) {
                    $this->dispatchBrowserEvent('notification', ['text' => $PDOException->getMessage(), 'variant'=>'error', 'time'=>3000, 'position'=>'right-top']);
                    // flash($PDOException->getMessage(), 'danger')->dismissable()->livewire($this);
                    return false;
                }

        }

    }


    protected function errorMessage($message)
    {

        return str_replace('form data.', '', $message);
    }

    /**
     * Salvar e ir para outra view
     */
    public function saveAndStay()
    {
        $this->submit();
    }

    /**
     * Salvar e ir para outra view
     */
    public function saveAndEditStay()
    {
        if ($this->submit())
            return $this->saveAndStayResponse();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveAndStayResponse()
    {
        return $this->saveAndGoBackResponse();
    }

    /**
     *
     */
    public function saveAndGoBack()
    {
        if ($this->submit()) {
            return $this->saveAndGoBackResponse();
        }

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveAndGoBackResponse()
    {

    }


    public function getRouteKeyName()
    {
        return Str::singular(Str::replaceFirst('-', '', $this->route));
    }


   
    protected function elements()
    {
        $fields = [];
        if ($this->fields()) {
            foreach ($this->fields() as $field) {
                $fields[$field->name] = $field;
            }
        }
        return $fields;
    }

    public function back($route, $params = [])
    {
        if(Route::has($route)){
            return route($route, array_merge(request()->query(), $params));
        }
        return null;
    }

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return $this->user();
    }

    protected function user()
    {
        return Auth::user();
    }

   

    public function __set($name, $value)
    {
        $this->{$name} = $value;
    }

    public function routeEdit(){
        
    }

    public function updateOrder($data){
        
    }
}
