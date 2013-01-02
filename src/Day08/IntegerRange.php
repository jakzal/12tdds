<?php

namespace Day08;

class IntegerRange
{
    private $lowestNumber = null;

    private $highestNumber = null;

    public function __construct($lowestNumber = 0, $highestNumber = 0)
    {
        if (!is_int($lowestNumber) || !is_int($highestNumber)) {
            throw new \InvalidArgumentException('Only integer numbers are supported');
        }

        if ($lowestNumber > $highestNumber) {
            throw new \InvalidArgumentException('Lowest number cannot be higher than the highest number');
        }

        $this->lowestNumber = $lowestNumber;
        $this->highestNumber = $highestNumber;
    }

    public function belongs($number)
    {
        return $number >= $this->lowestNumber && $number <= $this->highestNumber;
    }

    public function intersect(IntegerRange $range)
    {
        $lowestNumber = max($range->getLowestNumber(), $this->lowestNumber);
        $highestNumber = min($range->getHighestNumber(), $this->highestNumber);

        if ($lowestNumber <= $highestNumber) {
            return new IntegerRange($lowestNumber, $highestNumber);
        }

        return null;
    }

    public function getLowestNumber()
    {
        return $this->lowestNumber;
    }

    public function getHighestNumber()
    {
        return $this->highestNumber;
    }
}
