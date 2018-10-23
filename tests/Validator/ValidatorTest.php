<?php

namespace App\Validator;

use App\State\Active;
use App\State\Limited;
use App\State\NewState;
use App\State\Outdated;
use App\State\Removed;
use App\State\StateInterface;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function setUp()
    {
        $this->validator = new Validator();
    }

    /**
     * @param StateInterface $currentState
     * @param StateInterface $nextState
     * @throws InvalidTransitionException
     *
     * @dataProvider validTransitions
     */
    public function testValidateWithValidTransitionsReturnTrue(
        StateInterface $currentState,
        StateInterface $nextState
    ) {
        $this->assertTrue($this->validator->validate($currentState, $nextState));
    }

    /**
     * @param StateInterface $currentState
     * @param StateInterface $nextState
     * @throws InvalidTransitionException
     *
     * @dataProvider invalidTransitions
     * @expectedException App\Validator\InvalidTransitionException
     */
    public function testValidateWithInvalidTransitionThrowException(
        StateInterface $currentState,
        StateInterface $nextState
    ) {
        $this->assertTrue($this->validator->validate($currentState, $nextState));
    }

    /**
     * @return array
     */
    public function validTransitions(): array
    {
        return [
            [new NewState(), new Active()],
            [new NewState(), new Limited()],
            [new Limited(), new Active()],
            [new Active(), new Outdated()],
            [new Outdated(), new Active()],
            [new Outdated(), new Removed()],
        ];
    }

    public function invalidTransitions(): array
    {
        return [
            [new NewState(), new NewState()],
            [new NewState(), new Removed()],
            [new NewState(), new Outdated()],
            [new Limited(), new Limited()],
            [new Limited(), new NewState()],
            [new Limited(), new Outdated()],
            [new Limited(), new Removed()],
            [new Active(), new Active()],
            [new Active(), new NewState()],
            [new Active(), new Removed()],
            [new Outdated(), new Outdated()],
            [new Outdated(), new NewState()],
            [new Outdated(), new Limited()],
            [new Removed(), new Removed()],
            [new Removed(), new NewState()],
            [new Removed(), new Limited()],
            [new Removed(), new Active()],
            [new Removed(), new Outdated()],
        ];
    }
}
