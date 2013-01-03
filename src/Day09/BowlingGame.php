<?php

namespace Day09;

class BowlingGame
{
    private $rolls = null;

    private $currentRoll = 0;

    public function __construct()
    {
        $this->rolls = new \SplFixedArray(21);
    }

    public function roll($pins)
    {
        $this->rolls[$this->currentRoll++] = $pins;
    }

    public function calculateScore()
    {
        $score = 0;

        $frameIndex = 0;
        for ($frame = 0; $frame < 10; $frame++) {
            if ($this->isStrike($frameIndex)) {
                $score+= 10 + $this->calculateStrikeBonus($frameIndex);
                $frameIndex++;
            } elseif ($this->isSpare($frameIndex)) {
                $score+= 10 + $this->calculateSpareBonus($frameIndex);
                $frameIndex += 2;
            } else {
                $score += $this->calculateSumOfBallsInFrame($frameIndex);
                $frameIndex += 2;
            }
        }

        return $score;
    }

    private function isStrike($frameIndex)
    {
        return $this->rolls[$frameIndex] === 10;
    }

    private function isSpare($frameIndex)
    {
        return $this->rolls[$frameIndex] + $this->rolls[$frameIndex+1] === 10;
    }

    private function calculateStrikeBonus($frameIndex)
    {
        return $this->rolls[$frameIndex+1] + $this->rolls[$frameIndex+2];
    }

    private function calculateSpareBonus($frameIndex)
    {
        return $this->rolls[$frameIndex+2];
    }

    private function calculateSumOfBallsInFrame($frameIndex)
    {
        return $this->rolls[$frameIndex] + $this->rolls[$frameIndex+1];
    }
}
