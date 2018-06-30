<?php
class ImmAssoc implements ArrayAccess, Iterator
{
    public $arr;

    public function __construct(array $arr)
    {
        $this->arr = $arr;
        $this->keys = array_keys($this->arr);
    }

    public function set($i, $newval)
    {
        $arr = array_slice($this->arr, 0);
        $arr[$i] = $newval;
        return new static($arr);
    }

    /** @implements ArrayAccess */

    public function offsetExists ($offset) // : bool
    {
        return in_array($offset, $this->keys);
    }

    public function offsetGet ($offset) // : mixed
    {
        return $this->arr[$offset];
    }

    public function offsetSet ($offset, $value) // : void
    {
        return new Exception("Immutable: Please use #set method.");
    }

    public function offsetUnset ($offset) // : void
    {
        return new Exception("Immutable: Please use #set method.");
    }

    /* END @implements ArrayAccess */


    /** @implements Iterator */

    public function current() // : mixed
    {
        return $this[$this->current];
    }

    public function key() // : scalar
    {
        return $this->keys[$this->current];
    }

    public function next() // : void
    {
        return $this->arr[$this->current+1];
    }

    public function rewind() // : void
    {
        $this->current = 0;
    }

    public function valid() // : bool
    {
        return $this->offsetExists($this->keys[$this->current]);
    }

    /* END @implements Iterator */
}
