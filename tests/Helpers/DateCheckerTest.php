<?php

namespace HMRC\Test\Helpers;

use HMRC\Exceptions\InvalidDateFormatException;
use HMRC\Helpers\DateChecker;
use PHPUnit\Framework\TestCase;

class DateCheckerTest extends TestCase
{
    public function testItDoesntThrowsExceptionWhenGivenCorrectDateFormat()
    {
        DateChecker::checkDateStringFormat('2020-01-25', 'Y-m-d');

        $this->addToAssertionCount(1);
    }

    public function testItThrowsExceptionWhenGivenWrongDateFormat()
    {
        $this->expectException(InvalidDateFormatException::class);

        DateChecker::checkDateStringFormat('2020-01-25', 'Y');
    }
}
