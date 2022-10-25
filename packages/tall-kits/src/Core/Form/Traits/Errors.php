<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Kits\Core\Form\Traits;

trait Errors
{

    public function loadErrors($Service){

        if (isset($Service->Validation) && $Service->Validation) {
            $messages = [];
            $messages[] = $Service->Message;
            foreach ($Service->Validation as $value) {
                foreach ($value->Value as $key => $item) {
                    $messages[] = sprintf("%s - %s", $key, $item);
                }
            }
            $messageText = implode(PHP_EOL, $messages);
            // flash($messageText, 'danger')->dismissable()->livewire($this);
        } else {
            // flash($Service->Message, 'danger')->dismissable()->livewire($this);
        }
    }

    protected function isField($field){
        return isset($this->form_data[$field]) && $this->form_data[$field];
    }
}
