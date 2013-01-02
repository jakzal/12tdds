<?php

namespace Day08;

class FloatRange extends Range
{
    protected function createRange($lowestNumber, $highestNumber)
    {
        return new FloatRange($lowestNumber, $highestNumber);
    }
}
