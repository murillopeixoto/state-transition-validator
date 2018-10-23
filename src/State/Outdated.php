<?php

namespace App\State;

class Outdated extends StateAbstract
{
    protected function setPossibleTransitions(): void
    {
        $this->possibleTransitions = [
            Active::class,
            Removed::class,
        ];
    }
}
