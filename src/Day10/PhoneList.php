<?php

namespace Day10;

class PhoneList implements \ArrayAccess
{
    private $numbers = array();

    public function isConsistent()
    {
        foreach (array_keys($this->numbers) as $name) {
            if ($this->isNumberPrefixOfAnotherNumber($name)) {
                return false;
            }
        }

        return true;
    }

    private function isNumberPrefixOfAnotherNumber($name)
    {
        $numbers = $this->getNormalizedNumbers();
        $prefixNumber = $numbers[$name];
        unset($numbers[$name]);

        foreach ($numbers as $number) {
            if (0 === strpos($prefixNumber, $number)) {
                return true;
            }
        }

        return false;
    }

    public function offsetExists($name)
    {
        return array_key_exists($name, $this->numbers);
    }

    public function offsetGet($name)
    {
        if (!$this->offsetExists($name)) {
            throw new \InvalidArgumentException(sprintf('Unknown name: "%s"', $name));
        }

        return $this->numbers[$name];
    }

    public function offsetSet($name, $number)
    {
        $this->numbers[$name] = $number;
    }

    public function offsetUnset($name)
    {
        unset($this->numbers[$name]);
    }

    private function getNormalizedNumbers()
    {
        return array_map(function ($value) { return str_replace(' ', '', $value); }, $this->numbers);
    }
}
