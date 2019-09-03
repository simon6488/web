<?php
namespace Swoole\Table;

/**
 * @since 4.4.5
 */
class Row
{

    // property of the class Row
    public $key;
    public $value;

    /**
     * @param int $offset
     * @return mixed
     */
    public function offsetExists(int $offset){}

    /**
     * @param int $offset
     * @return mixed
     */
    public function offsetGet(int $offset){}

    /**
     * @param int $offset
     * @param $value
     * @return mixed
     */
    public function offsetSet(int $offset, $value){}

    /**
     * @param int $offset
     * @return mixed
     */
    public function offsetUnset(int $offset){}

    /**
     * @return mixed
     */
    public function __destruct(){}
}
