<?php

namespace App\State;

use PHPUnit\Framework\TestCase;

class ExtractorTest extends TestCase
{
    /**
     * @var ExtractorInterface
     */
    private $extractor;

    public function setUp()
    {
        $this->extractor = new Extractor();
    }

    /**
     * @throws InvalidStateException
     *
     * @dataProvider validStates
     */
    public function testExtractValidInputReturnsStateInstance(string $state, string $className)
    {
        $this->assertInstanceOf($className, $this->extractor->extract($state));
    }

    /**
     * @throws InvalidStateException
     *
     * @expectedException App\State\InvalidStateException
     */
    public function testExtractInvalidInputThrowsException()
    {
        $this->extractor->extract('InvalidState');
    }

    /**
     * @return array
     */
    public function validStates(): array
    {
        return [
            ['New', NewState::class],
            ['NewState', NewState::class],
            ['Limited', Limited::class],
            ['Active', Active::class],
            ['Outdated', Outdated::class],
            ['Removed', Removed::class],
        ];
    }
}
