<?php

namespace Day08;

abstract class Range
{
    private $lowestNumber = null;

    private $highestNumber = null;

    public function __construct($lowestNumber = 0, $highestNumber = 0)
    {
        if (!is_numeric($lowestNumber) || !is_numeric($highestNumber)) {
            throw new \InvalidArgumentException('Only numbers are supported');
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

    public function intersect(Range $range)
    {
        $lowestNumber = max($range->getLowestNumber(), $this->lowestNumber);
        $highestNumber = min($range->getHighestNumber(), $this->highestNumber);

        if ($lowestNumber <= $highestNumber) {
            return $this->createRange($lowestNumber, $highestNumber);
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

    abstract protected function createRange($lowestNumber, $highestNumber);
}
