<?php

namespace spec\Day05;

use PHPSpec2\Exception\Example\FailureException;
use PHPSpec2\Matcher\CustomMatchersProviderInterface;
use PHPSpec2\Matcher\InlineMatcher;
use PHPSpec2\ObjectBehavior;

class FizzBuzzIterator extends ObjectBehavior implements CustomMatchersProviderInterface
{
    function it_should_be_an_iterator()
    {
        $this->shouldHaveType('Iterator');
    }

    function it_should_replace_multiples_of_three_with_fizz()
    {
        $this->beConstructedWith(array(1, 2, 3));

        $this->shouldIterateWith(array(1, 2, 'Fizz'));
    }

    function it_should_replace_multiples_of_five_with_buzz()
    {
        $this->beConstructedWith(array(4, 5));

        $this->shouldIterateWith(array(4, 'Buzz'));
    }

    function it_should_replace_multiples_of_three_and_five_with_both_fizz_and_buzz()
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

    function it_should_return_non_numeric_items()
    {
        $this->beConstructedWith(array(1, 2, 'a', 'b'));

        $this->shouldIterateWith(array(1, 2, 'a', 'b'));
    }

    static public function getMatchers()
    {
        return array(
            new InlineMatcher('iterateWith', function($subject, $values) {
                foreach ($subject as $key => $value) {
                    if ($value !== $values[$key]) {

                        throw new FailureException(sprintf('Expected "%s" but got "%s"', $values[$key], $value));
                    }
                }

                return true;
            })
        );
    }
}
