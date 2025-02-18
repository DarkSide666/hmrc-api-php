<?php

namespace HMRC\Test\ServerToken;

use HMRC\ServerToken\ServerToken;
use PHPUnit\Framework\TestCase;

class ServerTokenTest extends TestCase
{
    public function testItCanSetServerToken()
    {
        $serverToken = uniqid();

        ServerToken::getInstance()->set($serverToken);

        $this->assertEquals($serverToken, ServerToken::getInstance()->get());
    }
}
