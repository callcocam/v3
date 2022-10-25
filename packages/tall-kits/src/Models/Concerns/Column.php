<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Kits\Models\Concerns;


/**
 * Class Column.
 */
trait Column
{

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
     * @return mixed
     */
    public function getTextAttribute($value): mixed
    {
       
        return $value;
    }

    /**
     * @return mixed
     */
    public function getAliasAttribute($value): mixed
    {
       
        return $value;
    }

    /**
     * @return mixed
     */
    public function getNameAttribute($value): mixed
    { 
        return $value;
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getViewAttribute($value): mixed
    {
        return $value;
    }

    /**
     * @return mixed
     */
    public function getColspanAttribute($value): mixed
    {
        return $value;
    }

    /**
     * @return mixed
     */
    public function getWidthAttribute($value): mixed
    {
        return $value;
    }

    /**
     * @return mixed
     */
    public function getVisibleAttribute($value): mixed
    {
        return $value;
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
        return $this->sortable;
    }

    /**
     * @return bool
     */
    public function isSearchable(): bool
    {
        return $this->searchable;
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
     * @return bool
     */
    public function sortable(callable $callable = null): bool
    {
        $this->sortCallback = $callable;

        return  $this->sortable;
    }

    /**
     * @param callable|null $callable
     *
     * @return bool
     */
    public function searchable(callable $callable = null): bool
    {
        $this->searchCallback = $callable;

        return $this->searchable;
    }

}
