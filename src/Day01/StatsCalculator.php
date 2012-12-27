<?php

namespace Day01;

class StatsCalculator
{
    public function run(array $data)
    {
        if (empty($data)) {
            throw new \InvalidArgumentException('Sequence cannot be empty');
        }

        return array(
            'min' => min($data),
            'max' => max($data),
            'count' => count($data),
            'avg' => round(array_sum($data) / count($data), 4)
        );
    }
}
