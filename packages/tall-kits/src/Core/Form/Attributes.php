<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Kits\Core\Form;

use Illuminate\View\AppendableAttributeValue;

class Attributes
{

    /**
     * The raw array of attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Create a new component attribute bag instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes =[])
    {
        $this->attributes = $attributes;
    }

    /**
     * Merge additional attributes / values into the attribute bag.
     *
     * @param  array  $attributeDefaults
     * @param  bool  $escape
     * @return static
     */
    public function merge(array $attributeDefaults = [], $escape = true)
    {
        $attributeDefaults = array_map(function ($value) use ($escape) {
            return $this->shouldEscapeAttributeValue($escape, $value)
                ? e($value)
                : $value;
        }, $attributeDefaults);

        [$appendableAttributes, $nonAppendableAttributes] = collect($this->attributes)
            ->partition(function ($value, $key) use ($attributeDefaults) {
                return $key === 'class' ||
                    (isset($attributeDefaults[$key]) &&
                        $attributeDefaults[$key] instanceof AppendableAttributeValue);
            });

        $attributes = $appendableAttributes->mapWithKeys(function ($value, $key) use ($attributeDefaults, $escape) {
            if(isset($attributeDefaults[$key]) && $attributeDefaults[$key] instanceof AppendableAttributeValue){
                $defaultsValue =  $this->resolveAppendableAttributeDefault($attributeDefaults, $key, $escape);
            }
            else{
                $defaultsValue =  ($attributeDefaults[$key] ?? '');
            }


            return [$key => implode(' ', array_unique(array_filter([$defaultsValue, $value])))];
        })->merge($nonAppendableAttributes)->all();

        return new static(array_merge($attributeDefaults, $attributes));
    }
    /**
     * Determine if the specific attribute value should be escaped.
     *
     * @param  bool  $escape
     * @param  mixed  $value
     * @return bool
     */
    protected function shouldEscapeAttributeValue($escape, $value)
    {
        if (! $escape) {
            return false;
        }

        return ! is_object($value) &&
            ! is_null($value) &&
            ! is_bool($value);
    }

    /**
     * Resolve an appendable attribute value default value.
     *
     * @param  array  $attributeDefaults
     * @param  string  $key
     * @param  bool  $escape
     * @return mixed
     */
    protected function resolveAppendableAttributeDefault($attributeDefaults, $key, $escape)
    {
        if ($this->shouldEscapeAttributeValue($escape, $value = $attributeDefaults[$key]->value)) {
            $value = e($value);
        }

        return $value;
    }

    /**
     * Implode the attributes into a single HTML ready string.
     *
     * @return string
     */
    public function __toString()
    {
        $string = '';
        foreach ($this->attributes as $key => $value) {
            if ($value === false || is_null($value)) {
                continue;
            }

            if ($value === true) {
                $value = $key;
            }

            $string .= ' '.$key.'="'.str_replace('"', '\\"', trim($value)).'"';
        }

        return trim($string);
    }

}
