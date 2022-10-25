<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Kits\Core\Form;


use Tall\Kits\Core\Form\Traits\Attributes;

class Field extends BaseField
{

    use Attributes;
    protected $class = 'form-input peer w-full rounded-full border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent';
    protected $sort  = false;
    protected $condition  = true;

    /**
     * @param $label
     * @param null $name
     * @return static
     */
    public static function make($label, $name = null)
    {
        return new static($label, $name);
    }

    /**
     * @param null $name
     * @return static
     */
    public static function blank( $name)
    {
        $field = new static($name, null);
        $field->view('hiiden');
        $field->component('tall-input');
        return $field;
    }


    /**
     * @return $this
     */
    public static function money($label, $name = null)
    {
        $field = new static($label, $name);
        $field->view('money');
        $field->component('tall-money');
        return $field;
    }


    /**
     * @return $this
     */
    public static function date($label, $name = null)
    {
        $field = new static($label, $name);
        $field->view('date');
        $field->attribute('type', 'date');
        return $field;
    }


    /**
     * @return $this
     */
    public static function color($label, $name = null)
    {
        $field = new static($label, $name);
        $field->view('color');
        $field->attribute('type', 'color');
        return $field;
    }
       
    /**
     * @return $this
     */
    public static function cover($label, $name = null)
    {
        $field = new static($label, $name);
        $field->default = config("form.default-no-image");
        $field->view('cover');
        $field->attribute('type', 'file');
        return $field;
    }
    /**
     * @return $this
     */
    public static function avatar($label, $name = null, $alias = null)
    {
        $field = new static($label, $name);
        $field->view('avatar');
        $field->component('tall-avatar');
        $field->setKey(sprintf("files.%s", $field->name));
        $field->attribute($field->wire_model, $field->key);
        $field->attribute('class', 'hidden');
        $field->attribute('type', 'file');
        $field->props('alias', $alias ?? $field->name);
        return $field;
    }
       
    /**
     * @return $this
     */
    public static function textarea($label, $name = null)
    {
        $field = new static($label, $name);
        $field->view('textarea');
        $field->component('tall-textarea');
        return $field;

    }

    /**
     * @return $this
     */
    public static function file_preview($label, $name = null,$span = "12")
    {
       return self::file($label, $name, 'file-review')->span($span);
    }
    /**
     * @return $this
     */
    public static function file($label, $name = null, $file = 'file')
    {
        $field = new static($label, $name);
        $field->class = sprintf("%s cursor-pointer", $field->class);
        $field->attribute('type', 'text');
        $field->attribute('style', 'cursor:pointer;');
        $field->attribute('readonly', true);
        $field->view($file);
        return $field;
    }

    /**
     * @param array $options
     * @return $this
     */
    public static function checkbox($label, $name = null, $options=[])
    {
        $field = new static($label, $name);
        $field->options($options);
        $field->attribute('type', 'checkbox');
        $field->view('checkbox');
        $field->component('tall-checkbox');
        return $field;
    }

    /**
     * @return $this
     */
    public static function radio($label, $name = null, $options=[])
    {
        $field = new static($label, $name);
        $field->options($options);
        $field->view('radio');
        $field->component('tall-radio');
        $field->attribute('type', 'radio');
        $field->attribute('class', 'form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 bg-slate-100 checked:!border-warning checked:!bg-warning hover:!border-warning focus:!border-warning dark:border-navy-500 dark:bg-navy-900');
        return $field;
    }

    /**
     * @return $this
     */
    public static function password($label, $name = null)
    {
        $field = new static($label, $name);
        $field->attribute('type', 'password');
        return $field;
    }

    /**
     * @return $this
     */
    public static function email($label, $name = "email")
    {
        $field = new static($label, $name);
        $field->icon('fa-regular fa-envelope text-base');
        $field->attribute('type', 'email');
        return $field;
    }

    /**
     * @return $this
     */
    public static function phone($label, $name = "phone")
    {
        $field = new static($label, $name);
        $field->attribute('type', 'phone');
        $field->icon('fa fa-phone');
        return $field;
    }



    /**
     * @return $this
     */
    public static function select($label, $name = null, $options=[])
    {
        $field = new static($label, $name);
        $field->view('select');
        $field->component('tall-select');
        $field->options($options);
        $field->attribute('type', null);
        return $field;
    }

    /**
     * @return $this
     */
    public function diveder($view='diveder')
    {
        $this->view($view);
        return $this;
    }


    /**
     * @return $this
     */
    public function sort()
    {
        $this->sort = true;
        return $this;
    }


    /**
     * @param array $fields
     * @return $this
     */
    public static function array($label, $name = null ,$fields = [])
    {
        $field = new static($label, $name);
        $field->attribute('type', 'array');
        foreach ($fields as $key =>$field)
        {
            $field->key = sprintf("%s.%s", $field->key, $field->name);
            $field->array_fields[$key] = $field;
        }
        return $field;
    }

    /**
     * @return $this
     */
    public function sortable()
    {
        $this->arry_sortable = true;
        return $this;
    }

    /**
     * @return $this
     */
    public function hiddenIf($condition)
    {
        $this->condition = $condition;
        return $this;
    }


}
