<?php

namespace App\Command;

use PHPUnit\Framework\TestCase;

class ArgumentGetterTest extends TestCase
{
    /**
     * @throws InvalidInputException
     *
     * @expectedException App\Command\InvalidInputException
     */
    public function testGetArgWithoutCurrentStateThrowException()
    {
        ArgumentGetter::getArg('current', []);
    }

    /**
     * @throws InvalidInputException
     *
     * @expectedException App\Command\InvalidInputException
     */
    public function testGetArgWithoutNextStateThrowException()
    {
        ArgumentGetter::getArg('next', ['Active']);
    }

    /**
     * @throws InvalidInputException
     */
    public function testGetArgCurrentWithCorrectParametersReturnValue()
    {
        $this->assertEquals('Active', ArgumentGetter::getArg('current', ['Active', 'Limited']));
    }

    /**
     * @throws InvalidInputException
     */
    public function testGetArgNextWithCorrectParametersReturnValue()
    {
        $this->assertEquals('Limited', ArgumentGetter::getArg('next', ['Active', 'Limited']));
    }
}
