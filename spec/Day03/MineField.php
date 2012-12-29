<?php

namespace spec\Day03;

use PHPSpec2\ObjectBehavior;

class MineField extends ObjectBehavior
{
    function it_should_return_mine_location()
    {
        $this->beConstructedWith(array(array('*')));

        $this->getHintField()->shouldReturn(array(array('*')));
    }

    function it_should_return_mine_location_and_hint_for_mine_at_the_beginning()
    {
        $this->beConstructedWith(array(array('*', '.', '.')));

        $this->getHintField()->shouldReturn(array(array('*', 1, 0)));
    }

    function it_should_return_mine_location_and_hint_for_mine_at_the_end()
    {
        $this->beConstructedWith(array(array('.', '.', '*')));

        $this->getHintField()->shouldReturn(array(array(0, 1, '*')));
    }

    function it_should_return_no_hints_for_empty_field()
    {
        $this->beConstructedWith(array(array('.', '.', '.')));

        $this->getHintField()->shouldReturn(array(array(0, 0, 0)));
    }

    function it_should_return_mine_location_and_hits_in_multiple_dimensions()
    {
        $this->beConstructedWith(array(
            array('.', '*', '*'),
            array('.', '.', '.'),
            array('.', '*', '.'),
            array('.', '.', '.'),
            array('.', '.', '.')
        ));

        $this->getHintField()->shouldReturn(array(
            array(1, '*', '*'),
            array(2, 3, 3),
            array(1, '*', 1),
            array(1, 1, 1),
            array(0, 0, 0)
        ));
    }
}
