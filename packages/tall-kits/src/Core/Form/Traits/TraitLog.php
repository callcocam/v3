<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace Tall\Kits\Core\Form\Traits;

trait TraitLog
{
    protected function logCreated($description,$status)
    {
       
       $this->model->logs()->create([
           "name"=>"Criado",
           "user_id"=>auth()->user()->id,
           "description"=>$description,
           "status"=>$status,
           "created_at" => now()->subHours(3)->format("Y-m-d H:i:s"),
           "updated_at" => now()->subHours(3)->format("Y-m-d H:i:s"),
       ]);
    }

    protected function logAtualizar($description,$status)
    {
           //echo $status;
        $this->model->logs()->create([
            "name"=>"Atualizado",
            "user_id"=>auth()->user()->id,
            "description"=>$description,
            "status"=>$status,
            "created_at" => now()->subHours(3)->format("Y-m-d H:i:s"),
            "updated_at" => now()->subHours(3)->format("Y-m-d H:i:s"),
        ]);
    }

    protected function logDeleted($description,$status)
    {
        $this->model->logs()->create([
            "name"=>"Deletado",
            "user_id"=>auth()->user()->id,
            "description"=>$description,
            "status"=>"deletado",
            "created_at" => now()->subHours(3)->format("Y-m-d H:i:s"),
            "updated_at" => now()->subHours(3)->format("Y-m-d H:i:s"),
        ]);
    }
}
