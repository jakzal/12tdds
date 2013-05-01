<?php

namespace spec\Day06;

use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;

class RecentlyUsedListSpec extends ObjectBehavior
{
    function it_should_be_traversable()
    {
        $this->shouldBeAnInstanceOf('Traversable');
    }

    function it_is_initialiazed_empty()
    {
        $this->count()->shouldReturn(0);
    }

    function it_should_add_most_recent_item_first()
    {
        $this->add('Item 1');
        $this->add('Item 2');
        $this->add('Item 3');

        $this->count()->shouldReturn(3);
        $this->shouldIterateWith(array('Item 3', 'Item 2', 'Item 1'));
    }

    function it_should_retrieve_item_by_index()
    {
        $this->add('Item 1');
        $this->add('Item 2');
        $this->add('Item 3');

        // array access is currently broken in phpspec
        $this->getAt(0)->shouldReturn('Item 3');
        $this->getAt(1)->shouldReturn('Item 2');
        $this->getAt(2)->shouldReturn('Item 1');
    }

    function it_should_complain_if_requested_item_is_not_there()
    {
        $this->shouldThrow(new \InvalidArgumentException('Item at index "0" does not exist'))->duringGetAt(0);
    }

    function it_should_move_duplicate_item()
    {
        $this->add('Item 1');
        $this->add('Item 2');
        $this->add('Item 3');
        $this->add('Item 2');

        $this->count()->shouldReturn(3);
        $this->shouldIterateWith(array('Item 2', 'Item 3', 'Item 1'));
    }

    function it_should_not_accept_empty_item()
    {
        $this->shouldThrow(new \InvalidArgumentException('Item cannot be empty'))->duringAdd('');
    }

    function it_should_drop_items_if_capacity_is_specified()
    {
        $this->beConstructedWith(2);

        $this->add('Item 1');
        $this->add('Item 2');
        $this->add('Item 3');

        $this->count()->shouldReturn(2);
        $this->shouldIterateWith(array('Item 3', 'Item 2'));
    }

    public function getMatchers()
    {
        return array(
            'iterateWith' => function($subject, $values) {
                foreach ($subject as $key => $value) {
                    if ($value !== $values[$key]) {

                        throw new FailureException(sprintf('Expected "%s" but got "%s"', $values[$key], $value));
                    }
                }

                return true;
            }
        );
    }
}
