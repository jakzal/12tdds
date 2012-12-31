<?php

namespace Day06;

class RecentlyUsedList implements \Iterator
{
    private $items = array();

    private $currentIndex = 0;

    private $capacity = null;

    public function __construct($capacity = null)
    {
        $this->capacity = $capacity;
    }

    public function add($item)
    {
        $this->validateItem($item);
        $this->removeItemIfExists($item);
        $this->removeLastItemIfCapacityReached();

        array_unshift($this->items, $item);
    }

    public function getAt($index)
    {
        if (!isset($this->items[$index])) {
            throw new \InvalidArgumentException(sprintf('Item at index "%d" does not exist', $index));
        }

        return $this->items[$index];
    }

    public function count()
    {
        return count($this->items);
    }

    public function current()
    {
        return $this->items[$this->currentIndex];
    }

    public function key()
    {
        return $this->currentIndex;
    }

    public function next()
    {
        $this->currentIndex++;
    }

    public function rewind()
    {
        $this->currentIndex = 0;
    }

    public function valid()
    {
        return isset($this->items[$this->currentIndex]);
    }

    private function validateItem($item)
    {
        if (empty($item)) {
            throw new \InvalidArgumentException('Item cannot be empty');
        }
    }

    private function removeItemIfExists($item)
    {
        if (false !== $key = array_search($item, $this->items)) {
            unset($this->items[$key]);
        }
    }

    private function removeLastItemIfCapacityReached()
    {
        if (is_int($this->capacity) && $this->count() === $this->capacity) {
            array_pop($this->items);
        }
    }
}
