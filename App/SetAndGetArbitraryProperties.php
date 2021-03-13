<?php


namespace App;

/**
 * Trait SetAndGetArbitraryProperties
 * @package App
 */
trait SetAndGetArbitraryProperties
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value): void
    {
        $this->data[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name): bool
    {
        return isset($this->data[$name]);
    }

    /**
     * @param $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->data[$offset]);
    }

    /**
     * @param $offset
     * @return array|null
     */
    public function offsetGet($offset): ?array
    {
        return $this->data[$offset] ?? null;
    }

    /**
     * @param $offset
     * @param $value
     */
    public function offsetSet($offset, $value): void
    {
        $this->data[$offset] = $value;
    }

    /**
     * @param $offset
     */
    public function offsetUnset($offset): void
    {
        unset($this->data[$offset]);
    }
}
