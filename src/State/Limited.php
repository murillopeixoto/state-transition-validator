<?php

namespace App\State;

class Limited extends StateAbstract
{
    protected function setPossibleTransitions(): void
    {
        $this->possibleTransitions = [
            Active::class,
        ];
    }
}
