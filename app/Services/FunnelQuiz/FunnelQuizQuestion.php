<?php

namespace App\Services\FunnelQuiz;

abstract class FunnelQuizQuestion
{
    abstract public function options(): array;

    public function calculateScore()
    {

    }
}
