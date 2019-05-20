<?php namespace SentoWeb\LicenseJet\Collection;

use SentoWeb\LicenseJet\Resource\Resource;

Class BaseCollection implements \ArrayAccess {
    protected $data = [];

    protected $start;
    protected $end;
    protected $page;

    public function __construct(array $data = null)
    {
        $this->data = $data;
    }

    public function toArray() : array
    {
        return array_map(function (Resource $model)
        {
            return $model->toArray();
        }, $this->get());
    }

    public function setItems($data) : void
    {
        $this->data = $data;
    }

    public function getNextPage() : int
    {
        return $this->page + 1;
    }

    public function getPreviousPage() : int
    {
        return $this->page - 1;
    }

    public function map($callback) : array
    {
        return array_map($callback, $this->get());
    }

    public function count() : int
    {
        return count($this->data);
    }

    public function get() : array
    {
        return $this->data;
    }

    public function contains($modelId) : bool {
        return count(array_filter($this->get(), function (Resource $model) use($modelId) {
            return $model->getId() == $modelId;
        })) != 0;
    }

    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }
}