<?php

/**
 * Trie root
 */
class Trie
{
    protected $children;

    public function __construct($children = [])
    {
        $this->children = $children;
    }

    public function fromArray(array $array)
    {
        foreach ($array as $key => $value) {
            $path = str_split($key);
            $focusNode = $this;
            foreach ($path as $depth => $k) {
                $node = new Node();
                $focusNode->addChild($k, $node);
                $focusNode = $node;
            }
        }
    }

    public function add($key, $value)
    {
        $this->addChild(str_split($key), new Node($value));
    }

    public function get($key)
    {
        return ($child = $this->getChild(str_split($key)))? $child->getValue() : null;
    }

    public function remove($key)
    {
        return $this->removeChild(str_split($key));
    }

    public function addChild(array $path, $node)
    {
        $head = $path[0];
        $tail = array_slice($path, 1);

        // One letter child
        if (count($tail) == 0) {
            $this->children[$head] = $node;
            return;
        }

        // Add first child
        $this->children[$head] = new Node($head);
        $this->children[$head]->addChild($head, $tail, $node);
    }

    public function getChild(array $path)
    {
        $head = $path[0];
        $tail = array_slice($path, 1);
        if (!isset($this->children[$head])) {
            return null;
        }
        $child = $this->children[$head];

        return (count($tail) == 0)? $child : $child->getChild($head, $tail);
    }

    public function removeChild(array $path)
    {
        $head = $path[0];
        $tail = array_slice($path, 1);
        $child = $this->children[$head];
    }
}
