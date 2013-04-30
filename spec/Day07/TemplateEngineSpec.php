<?php

namespace spec\Day07;

use Day07\MissingValueException;
use Day07\VariableMap;
use PhpSpec\ObjectBehavior;

class TemplateEngineSpec extends ObjectBehavior
{
    function let(VariableMap $variableMap)
    {
    }

    function it_should_evaluate_template_without_variables($variableMap)
    {
        $this->evaluate('Hello', $variableMap)
            ->shouldReturn('Hello');
    }

    function it_should_evaluate_template_with_single_variable($variableMap)
    {
        $variableMap->get('name')->willReturn('Kuba')->shouldBeCalled();

        $this->evaluate('Hello {$name}', $variableMap)
            ->shouldReturn('Hello Kuba');
    }

    function it_should_evaluate_template_with_mutliple_variables($variableMap)
    {
        $variableMap->get('firstName')->willReturn('Chuck')->shouldBeCalled();
        $variableMap->get('lastName')->willReturn('Norris')->shouldBeCalled();

        $this->evaluate('Hello {$firstName} {$lastName}', $variableMap)
            ->shouldReturn('Hello Chuck Norris');
    }

    function it_should_give_error_if_variable_does_not_exist_in_the_map($variableMap)
    {
        $variableMap->get('name')->willReturn(null);

        $this->shouldThrow(new MissingValueException('Missing variable: "name"'))
            ->duringEvaluate('Hello {$name}', $variableMap);
    }

    function it_should_evaluate_complex_cases($variableMap)
    {
        $variableMap->get('name')->willReturn('Kuba');

        $this->evaluate('Hello ${{$name}}', $variableMap)
            ->shouldReturn('Hello ${Kuba}');
    }
}
