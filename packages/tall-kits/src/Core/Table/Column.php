<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Kits\Core\Table;

use Illuminate\Support\Str;
use Tall\Kits\Core\Table\Traits\CanBeHidden;

/**
 * Class Column.
 */
class Column
{
    use CanBeHidden;

    /**
     * @var string
     */
    protected $view;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var string
     */
    protected $colspan;

    /**
     * @var string
     */
    protected $width;

    /**
     * @var string
     */
    protected $name;

    /**
     * The raw array of attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * @var bool
     */
    protected $sortable = false;

    /**
     * @var bool
     */
    protected $searchable = false;

    /**
     * @var
     */
    protected $formatCallback;

    /**
     * @var
     */
    protected $sortCallback;

    /**
     * @var null
     */
    protected $searchCallback;

    /**
     * Column constructor.
     *
     * @param string $text
     * @param string|null $attribute
     */
    public function __construct(string $text, ?string $attribute)
    {
        $this->text = $text;
        $this->name = $attribute ?? Str::snake(Str::lower($text));
    }

    /**
     * @param string $text
     * @param string|null $attribute
     *
     * @return Column
     */
    public static function make(string $text, ?string $attribute = null): Column
    {
        return new static($text, $attribute);
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getAttribute(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @return string
     */
    public function __get($name)
    {
        return $this->{$name};
    }

    /**
     * @return mixed
     */
    public function getSortCallback()
    {
        return $this->sortCallback;
    }

    /**
     * @return mixed
     */
    public function getSearchCallback()
    {
        return $this->searchCallback;
    }

    /**
     * @return bool
     */
    public function isFormatted(): bool
    {
        return is_callable($this->formatCallback);
    }

    /**
     * @return bool
     */
    public function isSortable(): bool
    {
        return $this->sortable === true;
    }

    /**
     * @return bool
     */
    public function isSearchable(): bool
    {
        return $this->searchable === true;
    }

    /**
     * @param callable $callable
     *
     * @return $this
     */
    public function format(callable $callable): Column
    {
        $this->formatCallback = $callable;

        return $this;
    }

    /**
     * @param $model
     * @param $column
     *
     * @return mixed
     */
    public function formatted($model, $column)
    {
        return app()->call($this->formatCallback, ['model' => $model, 'column' => $column]);
    }

    /**
     * @param callable|null $callable
     *
     * @return $this
     */
    public function sortable(callable $callable = null): self
    {
        $this->sortCallback = $callable;
        $this->sortable = true;

        return $this;
    }

    /**
     * @param callable|null $callable
     *
     * @return $this
     */
    public function searchable(callable $callable = null): self
    {
        $this->searchCallback = $callable;
        $this->searchable = true;

        return $this;
    }

    /**
     * @param $view
     * @return $this
     */
    public function view($view): self
    {
        $this->view = $view;

        return $this;
    }

    /**
     * @param $colspan
     * @return $this
     */
    public function colspan($colspan): self
    {
        $this->colspan = $colspan;

        return $this;
    }

    /**
     * @param $width
     * @return $this
     */
    public function width($width): self
    {
        $this->attributes['width'] = $width;

        return $this;
    }


}
