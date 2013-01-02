<?php

namespace Day08;

class IntegerRange extends Range
{
    public function __construct($lowestNumber = 0, $highestNumber = 0)
    {
        if (!is_int($lowestNumber) || !is_int($highestNumber)) {
            throw new \InvalidArgumentException('Only integer numbers are supported');
        }

        parent::__construct($lowestNumber, $highestNumber);
    }

    protected function createRange($lowestNumber, $highestNumber)
    {
        return new IntegerRange($lowestNumber, $highestNumber);
    }
}
