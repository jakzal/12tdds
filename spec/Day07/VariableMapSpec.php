<?php

namespace spec\Day07;

use PhpSpec\ObjectBehavior;

class VariableMapSpec extends ObjectBehavior
{
    function it_stores_variables()
    {
        $this->put('firstName', 'Chuck');
        $this->put('lastName', 'Norris');

        $this->get('firstName')->shouldReturn('Chuck');
        $this->get('lastName')->shouldReturn('Norris');
    }

    function it_returns_null_for_unknown_variable()
    {
        $this->get('name')->shouldReturn(null);
    }
}
