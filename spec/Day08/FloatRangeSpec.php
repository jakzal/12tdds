<?php

namespace spec\Day08;

use PhpSpec\ObjectBehavior;

class FloatRangeSpec extends ObjectBehavior
{
    function it_should_return_true_if_a_number_lies_in_the_range()
    {
        $this->beConstructedWith(0, 10.75);

        $this->belongs(0)->shouldReturn(true);
        $this->belongs(5.5)->shouldReturn(true);
        $this->belongs(10.75)->shouldReturn(true);
    }

    function it_should_return_false_if_a_number_lies_outside_of_the_range()
    {
        $this->beConstructedWith(0, 10.5);

        $this->belongs(11)->shouldReturn(false);
    }

    function it_should_calculate_intersection_of_two_ranges()
    {
        $this->beConstructedWith(0.5, 3.5);

        $range = $this->intersect($this->createRange(2.75, 4));

        $range->shouldBeAnInstanceOf('Day08\FloatRange');
        $range->getLowestNumber()->shouldReturn(2.75);
        $range->getHighestNumber()->shouldReturn(3.5);
    }

    function it_should_calculate_intersection_of_one_element_set()
    {
        $this->beConstructedWith(0.5, 3.5);

        $range = $this->intersect($this->createRange(3.5, 4));

        $range->shouldBeAnInstanceOf('Day08\FloatRange');
        $range->getLowestNumber()->shouldReturn(3.5);
        $range->getHighestNumber()->shouldReturn(3.5);
    }

    function it_should_return_null_if_there_is_no_intersection()
    {
        $this->beConstructedWith(0, 3.5);

        $range = $this->intersect($this->createRange(3.6, 5))->shouldReturn(null);
    }

    function it_should_throw_exception_if_lowest_number_is_higher_than_highest()
    {
        $exception = new \InvalidArgumentException('Lowest number cannot be higher than the highest number');

        $this->shouldThrow($exception)->during('__construct', array(2.6, 2.5));
    }

    function it_should_only_work_with_numbers()
    {
        $exception = new \InvalidArgumentException('Only numbers are supported');

        $this->shouldThrow($exception)->during('__construct', array('a', 3));
        $this->shouldThrow($exception)->during('__construct', array(1, 'b'));
    }

    private function createRange($lowestNumber, $highestNumber)
    {
        return new \Day08\FloatRange($lowestNumber, $highestNumber);
    }
}
