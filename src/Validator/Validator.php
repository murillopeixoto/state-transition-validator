<?php

namespace App\Validator;

use App\State\StateInterface;
use App\State\Translator;

class Validator implements ValidatorInterface
{
    const MESSAGE = '`%s` cannot transit to `%s`';

    /**
     * @param StateInterface $currentState
     * @param StateInterface $nextState
     * @return bool
     * @throws InvalidTransitionException
     * @throws \ReflectionException
     */
    public function validate(StateInterface $currentState, StateInterface $nextState): bool
    {
        if (!in_array(get_class($nextState), $currentState->getPossibleTransitions())) {
            throw new InvalidTransitionException(sprintf(
                self::MESSAGE,
                $this->getStateName($currentState),
                $this->getStateName($nextState)
            ));
        }

        return true;
    }

    /**
     * @param StateInterface $state
     * @return string
     * @throws \ReflectionException
     */
    private function getStateName(StateInterface $state)
    {
        return Translator::classNameToState((new \ReflectionClass($state))->getShortName());
    }
}
