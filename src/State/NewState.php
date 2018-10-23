<?php

namespace App\State;

class NewState extends StateAbstract
{
    protected function setPossibleTransitions(): void
    {
        $this->possibleTransitions = [
            Limited::class,
            Active::class
        ];
    }
}
