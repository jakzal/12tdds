<?php

namespace spec\Day01;

use PhpSpec\ObjectBehavior;

class StatsCalculatorSpec extends ObjectBehavior
{
    function it_should_throw_an_exception_for_an_empty_sequence()
    {
        $this->shouldThrow(new \InvalidArgumentException('Sequence cannot be empty'))
            ->duringRun(array());
    }

    function it_should_calculate_min_value()
    {
        $this->run(array(6, 9, 15, -2, 92, 11))->shouldContain('min', -2);
    }

    function it_should_calculate_max_value()
    {
        $this->run(array(6, 9, 15, -2, 92, 11))->shouldContain('max', 92);
    }

    function it_should_calculate_total_number_of_elements()
    {
        $this->run(array(6, 9, 15, -2, 92, 11))->shouldContain('count', 6);
    }

    function it_should_calculate_average_value_of_elements()
    {
        $this->run(array(6, 9, 15, -2, 92, 11))->shouldContain('avg', 21.8333);
    }

    public function getMatchers()
    {
        return array(
            'contain' => function($subject, $key, $value) {
                return array_key_exists($key, $subject) && $subject[$key] === $value;
            }
        );
    }
}
