<?php

namespace App\State;

class Active extends StateAbstract
{
    protected function setPossibleTransitions(): void
    {
        $this->possibleTransitions = [
            Outdated::class,
        ];
    }
}
