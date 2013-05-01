<?php

namespace spec\Day10;

use PhpSpec\ObjectBehavior;

class PhoneListSpec extends ObjectBehavior
{
    function it_should_act_as_an_array()
    {
        $this->shouldBeAnInstanceOf('ArrayAccess');

        $this['Bob'] = '91 12 54 26';
        $this['Bob']->shouldReturn('91 12 54 26');
        expect(isset($this['Bob']))->toBe(true);
        unset($this['Bob']);

        expect(isset($this['Bob']))->toBe(false);
        $this->shouldThrow(new \InvalidArgumentException('Unknown name: "Bob"'))->duringOffsetGet('Bob');
    }

    function it_should_be_consistent_if_empty()
    {
        $this->isConsistent()->shouldReturn(true);
    }

    function it_should_be_consistent_if_no_number_is_a_prefix_of_another_one()
    {
        $this['Bob'] = '91 12 54 26';
        $this['Alice'] = '97 625 992';
        $this['Emergency'] = '112';

        $this->isConsistent()->shouldReturn(true);
    }

    function it_should_not_be_consistent_if_a_number_is_a_prefix_of_another_one()
    {
        $this['Bob'] = '91 12 54 26';
        $this['Alice'] = '97 625 992';
        $this['Emergency'] = '911';

        $this->isConsistent()->shouldReturn(false);
    }
}
