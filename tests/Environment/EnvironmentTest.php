<?php

namespace HMRC\Test\Environment;

use HMRC\Environment\Environment;
use HMRC\Exceptions\InvalidVariableValueException;
use PHPUnit\Framework\TestCase;

class EnvironmentTest extends TestCase
{
    /** @var Environment */
    private $environment;

    protected function setUp(): void
    {
        $this->environment = Environment::getInstance();
    }

    public function testItUsesSandboxModeByDefault()
    {
        $this->assertEquals(true, $this->environment->isSandbox());
    }

    public function testItThrowsExceptionWhenGivenWrongEnvironment()
    {
        $this->expectException(InvalidVariableValueException::class);

        $this->environment->setEnv('wrong');
    }

    public function testItAcceptsCorrectEnvironment()
    {
        $this->environment->setEnv(Environment::LIVE);

        $this->addToAssertionCount(1);
    }

    public function testItCanBeReset()
    {
        $this->assertEquals(true, Environment::getInstance()->isSandbox());

        Environment::getInstance()->setToLive();
        $this->assertEquals(true, Environment::getInstance()->isLive());

        Environment::reset();
        $this->assertEquals(true, Environment::getInstance()->isSandbox());
    }

    protected function tearDown(): void
    {
        Environment::reset();
    }
}
