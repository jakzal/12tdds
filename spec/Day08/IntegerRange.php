<?php

namespace spec\Day08;

use PHPSpec2\ObjectBehavior;

class IntegerRange extends ObjectBehavior
{
    function it_should_return_true_if_an_integer_lies_in_the_range()
    {
        $this->beConstructedWith(0, 10);

        $this->belongs(0)->shouldReturn(true);
        $this->belongs(5)->shouldReturn(true);
        $this->belongs(10)->shouldReturn(true);
    }

    function it_should_return_false_if_an_integer_lies_outside_of_the_range()
    {
        $this->beConstructedWith(0, 10);

        $this->belongs(11)->shouldReturn(false);
    }

    function it_should_calculate_intersection_of_two_ranges()
    {
        $this->beConstructedWith(0, 3);

        $range = $this->intersect($this->createRange(2, 4));

        $range->shouldBeAnInstanceOf('Day08\IntegerRange');
        $range->getLowestNumber()->shouldReturn(2);
        $range->getHighestNumber()->shouldReturn(3);
    }

    function it_should_calculate_intersection_of_one_element_set()
    {
        $this->beConstructedWith(0, 3);

        $range = $this->intersect($this->createRange(3, 4));

        $range->shouldBeAnInstanceOf('Day08\IntegerRange');
        $range->getLowestNumber()->shouldReturn(3);
        $range->getHighestNumber()->shouldReturn(3);
    }

    function it_should_return_null_if_there_is_no_intersection()
    {
        $this->beConstructedWith(0, 3);

        $range = $this->intersect($this->createRange(4, 5))->shouldReturn(null);
    }

    function it_should_throw_exception_if_lowest_number_is_higher_than_highest()
    {
        $exception = new \InvalidArgumentException('Lowest number cannot be higher than the highest number');

        $this->shouldThrow($exception)->during('__construct', array(4, 3));
    }

    function it_should_only_work_with_integers()
    {
        $exception = new \InvalidArgumentException('Only integer numbers are supported');

        $this->shouldThrow($exception)->during('__construct', array(1.3, 3));
        $this->shouldThrow($exception)->during('__construct', array(1, 3.33));
    }

    private function createRange($lowestNumber, $highestNumber)
    {
        return new \Day08\IntegerRange($lowestNumber, $highestNumber);
    }
}
