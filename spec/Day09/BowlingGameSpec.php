<?php

namespace spec\Day09;

use PhpSpec\ObjectBehavior;

class BowlingGameSpec extends ObjectBehavior
{
    function it_scores_zero_if_no_pins_are_hit()
    {
        $this->rollMany(20, 0);

        $this->calculateScore()->shouldReturn(0);
    }

    function it_gets_point_for_each_pin_hit()
    {
        $this->rollMany(20, 1);

        $this->calculateScore()->shouldReturn(20);
    }

    function it_adds_a_bonus_on_spare()
    {
        $this->rollSpare();
        $this->roll(3);
        $this->rollMany(17, 0);

        $this->calculateScore()->shouldReturn(16);
    }

    function it_adds_a_bonus_on_strike()
    {
        $this->rollStrike();
        $this->roll(3);
        $this->roll(4);
        $this->rollMany(16, 0);

        $this->calculateScore()->shouldReturn(24);
    }

    function it_allows_two_bonus_rolls_when_strike_occured_in_the_last_roll()
    {
        $this->rollMany(12, 10);

        $this->calculateScore()->shouldReturn(300);
    }

    private function rollMany($n, $score)
    {
        for ($i = 0; $i < $n; $i++) {
            $this->roll($score);
        }
    }

    private function rollSpare()
    {
        $this->roll(5);
        $this->roll(5);
    }

    private function rollStrike()
    {
        $this->roll(10);
    }
}
