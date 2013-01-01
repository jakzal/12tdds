<?php

namespace spec\Day07;

use PHPSpec2\ObjectBehavior;

class VariableMap extends ObjectBehavior
{
    function it_should_store_variables()
    {
        $this->put('firstName', 'Chuck');
        $this->put('lastName', 'Norris');

        $this->get('firstName')->shouldReturn('Chuck');
        $this->get('lastName')->shouldReturn('Norris');
    }

    function it_should_return_null_for_unknown_variable()
    {
        $this->get('name')->shouldReturn(null);
    }
}
