<?php

namespace Day05;

class FizzBuzzIterator extends \ArrayIterator
{
    public function current()
    {
        $value = parent::current();
        $replacement = $this->getReplacement($value);

        return empty($replacement) ? $value : $replacement;
    }

    private function getReplacement($value)
    {
        $result = '';

        foreach ($this->getReplacements() as $divider => $word) {
            if (is_int($value) && ($value % $divider) === 0) {
                $result.= $word;
            }
        }

        return $result;
    }

    private function getReplacements()
    {
        return array(3 => 'Fizz', 5 => 'Buzz');
    }
}
