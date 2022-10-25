<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Kits\Core\Table\Traits;


/**
 * Trait CanBeHidden.
 */
trait CanBeHidden
{
    /**
     * @var bool
     */
    protected $hidden = false;

    /**
     * @var bool
     */
    protected $hidden_head = false;

    /**
     * @param $condition
     *
     * @return $this
     */
    public function hideIf($condition): self
    {
        $this->hidden = $condition;

        return $this;
    }

    /**
     * @param null $model
     * @return $this
     */
    public function hide($model=null): self
    {
        $this->hidden = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function hidden_head(): self
    {
        $this->hidden_head = true;

        return $this;
    }

    /**
     * @param null $model
     * @return bool
     */
    public function isVisible($model=null): bool
    {
        if (is_callable($this->hidden)){
            return app()->call($this->hidden, ['model' => $model]);
        }
        return $this->hidden !== true;
    }

    /**
     * @return bool
     */
    public function isHeadVisible(): bool
    {
        return !$this->hidden_head;
    }

    /**
     * @param null $model
     * @return bool
     */
    public function isHidden($model=null): bool
    {
        return !$this->isVisible($model);
    }
}
