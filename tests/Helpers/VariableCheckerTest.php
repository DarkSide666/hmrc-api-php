<?php

namespace HMRC\Test\Helpers;

use HMRC\Exceptions\InvalidVariableValueException;
use HMRC\Helpers\VariableChecker;
use PHPUnit\Framework\TestCase;

class VariableCheckerTest extends TestCase
{
    public function testItThrowsExceptionWhenGivenInvalidVariableValue()
    {
        $this->expectException(InvalidVariableValueException::class);

        VariableChecker::checkPossibleValue(1, [2, 3]);
    }

    public function testItDoesntThrowExceptionWhenGivenCorrectVariableValue()
    {
        VariableChecker::checkPossibleValue(1, [1, 2]);

        $this->addToAssertionCount(1);
    }
}
