<?php

namespace App\Validator;

use App\State\StateInterface;

interface ValidatorInterface
{
    /**
     * @param StateInterface $currentState
     * @param StateInterface $nextState
     * @return bool
     * @throws InvalidTransitionException
     */
    public function validate(StateInterface $currentState, StateInterface $nextState): bool;
}
