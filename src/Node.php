<?php

/**
 * Node of Trie
 */
class Node
{
    protected $val;
    protected $children;

    public function __construct($val, $children = [])
    {
        $this->children = $children;
        $this->val = $val;
    }

    public function addChild($explored, array $path, $node)
    {
        if (count($path) == 1) {
            $this->children[$path[0]] = $node;
            return;
        }

        $head = $path[0];
        $tail = array_slice($path, 1);

        if (!isset($this->children[$head])) {
            $this->children[$head] = new static(null);
        }

        $this->children[$head]->addChild("$explored$head", $tail, $node);
    }

    public function getChild($explored, array $path)
    {
        if (!isset($this->children[$path[0]])) {
            return null;
        }

        // print "$this->val: "; print_r(array_keys($this->children)); print PHP_EOL;
        if (count($path) == 1) {
            return $this->children[$path[0]];
        }

        $head = $path[0];
        $tail = array_slice($path, 1);

        return $this->children[$head]->getChild("$explored$head", $tail);
    }

    public function getValue()
    {
        return $this->val;
    }
}
