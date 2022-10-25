<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Kits\Core\Form;


use Tall\Kits\Core\Form\Attributes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class BaseField
{


    protected $type;
    protected $icon;
    protected $component = 'tall-input';
    protected $attribute = [];
    protected $array_fields = [];
    protected $class = "form-control";
    protected $key;
    protected $label;
    protected $label_attributes;
    protected $name;
    protected $options = [];
    protected $props = [];
    protected $default;
    protected $help;
    protected $rules;
    protected $view;
    protected $link;
    protected $span = '12';
    protected $wire_model = "wire:model.defer";

    /**
     * Field constructor.
     * @param $label
     * @param $name
     */
    public function __construct($label, $name)
    {
        $this->label = $label;
        $this->name = $name ?? Str::snake(Str::lower($label));
        $this->key = sprintf("form_data.%s", $this->name);
        $this->attribute('name', $this->name);
        $this->attribute($this->wire_model, $this->key);
        $this->attribute('class', $this->class);
        $this->view('text');
    }

    /**
     * @param $property
     * @return mixed
     */
    public function __get($property)
    {
        return $this->{$property};
    }

    /**
     * @param $default
     * @return $this
     */
    public function component($component)
    {
        $this->component = $component;
        return $this;
    }

    /**
     * @param $default
     * @return $this
     */
    public function default($default)
    {
        $this->default = $default;
        return $this;
    }

    /**
     * @param $default
     * @return $this
     */
    public function icon($icon, $class="pl-9")
    {
        $this->icon = $icon;
        $this->class = sprintf("%s  %s", $this->class, $class);
        $this->attribute('class', $this->class);
        return $this;
    }

    /**
     * @param $span
     * @return $this
     */
    public function span($span)
    {
        $this->span = $span;
        return $this;
    }

    /**
     * @param $type
     * @return $this
     */
    public function type($type)
    {
        $this->type = $type;
        $this->attribute('type', $type);
        return $this;
    }

    /**
     * @param $title
     * @param string $placement
     * @return $this
     */
    public function tooltip($title, $placement = "top")
    {
        $this->attribute('title', $title);
        $this->attribute('data-bs-toggle', "tooltip");
        $this->attribute('data-bs-placement', $placement);
        return $this;
    }

    /**
     * @param $help
     * @return $this
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @param $help
     * @return $this
     */
    public function help($help)
    {
        $this->help = $help;
        return $this;
    }

    /**
     * @param $link
     * @return $this
     */
    public function link($link)
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @param $rules
     * @param array $data
     * @return $this
     */
    public function rules($rules, $data = [])
    {
        if (is_callable($rules)) {
            $this->rules = call_user_func($rules, $data);
        } else {
            $this->rules = $rules;
        }

        return $this;
    }

    /**
     * @param $view
     * @return $this
     */
    public function view($view)
    {
        $this->view = $view;
        return $this;
    }

    /**
     * @param $label
     * @return $this
     */
    public function label($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @param $options
     * @param bool $finished
     * @return BaseField
     */
    public function options($options, $finished = false)
    {

        if ($finished) {
            $this->options = $options;

            return $this;
        }
        $this->options = Arr::isAssoc($options) ? array_flip($options) : array_combine($options, $options);

        return $this;
    }

    /**
     * @param $attributes
     */
    public function props($prop, $value)
    {
        $this->props[$prop] = $value;

        return $this;
    }

    /**
     * @param $attributes
     */
    public function attribute($attribute, $value)
    {
        $this->attribute[$attribute] = $value;

        return $this;
    }

    public function attributes()
    {
        return $this->attribute;
    }

    /**
     * @param $options
     */
    public function has($key)
    {
        return isset($this->attribute[$key]);
    }

    /**
     * Merge additional attributes / values into the attribute bag.
     *
     * @param array $attributeDefaults
     * @param bool $escape
     * @return static
     */
    public function merge(array $attributeDefaults = [], $escape = true)
    {
        $attributes = new Attributes($this->attributes());

        return $attributes->merge($attributeDefaults, $escape);
    }


    public function model(Builder $model, $label="name", $id="id")
    {

        $this->options = $model->pluck( $label, $id)->toArray();
        return $this;
    }

    public function wire($model)
    {
        $this->wire_model = sprintf(".%s", $model);
        return $this;
    }
}
