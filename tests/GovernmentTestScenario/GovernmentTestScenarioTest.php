<?php

namespace HMRC\Test\GovernmentTestScenario;

use HMRC\Exceptions\InvalidVariableValueException;
use PHPUnit\Framework\TestCase;

class GovernmentTestScenarioTest extends TestCase
{
    /** @var StubGovTestScenario */
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new StubGovTestScenario();
    }

    public function testItGetsCorrectValidGovernmentTestScenarios()
    {
        $this->assertEquals([
            StubGovTestScenario::DEFAULT,
            StubGovTestScenario::SIMPLE_CASE,
            StubGovTestScenario::COMPLEX_CASE,
        ], $this->stub->getValidGovTestScenarios());
    }

    public function testItThrowsExceptionWhenGivenWrongGovernmentTestScenario()
    {
        $this->expectException(InvalidVariableValueException::class);

        $this->stub->checkValid('wrong');
    }

    public function testItDoesntThrowExceptionWhenGivenCorrectGovernmentTestScenario()
    {
        $this->stub->checkValid(StubGovTestScenario::SIMPLE_CASE);

        $this->addToAssertionCount(1);
    }
}
