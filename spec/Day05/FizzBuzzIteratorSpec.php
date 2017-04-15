<?php

namespace spec\Day05;

use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;

class FizzBuzzIteratorSpec extends ObjectBehavior
{
    function it_is_an_iterator()
    {
        $this->shouldHaveType('Iterator');
    }

    function it_replaces_multiples_of_three_with_fizz()
    {
        $this->beConstructedWith(array(1, 2, 3));

        $this->shouldIterateWith(array(1, 2, 'Fizz'));
    }

    function it_replaces_multiples_of_five_with_buzz()
    {
        $this->beConstructedWith(array(4, 5));

        $this->shouldIterateWith(array(4, 'Buzz'));
    }

    function it_replaces_multiples_of_three_and_five_with_both_fizz_and_buzz()
    {
        $this->beConstructedWith(array(
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10,
            11, 12, 13, 14, 15, 20, 30
        ));

        $this->shouldIterateWith(array(
            1, 2, 'Fizz', 4, 'Buzz', 'Fizz', 7, 8, 'Fizz', 'Buzz',
            11, 'Fizz', 13, 14, 'FizzBuzz', 'Buzz', 'FizzBuzz'
        ));
    }

    function it_returns_non_numeric_items()
    {
        $this->beConstructedWith(array(1, 2, 'a', 'b'));

        $this->shouldIterateWith(array(1, 2, 'a', 'b'));
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
