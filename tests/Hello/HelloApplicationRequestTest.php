<?php

namespace HMRC\Test\Hello;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use HMRC\Exceptions\EmptyServerTokenException;
use HMRC\Hello\HelloApplicationRequest;
use HMRC\Request\RequestMethod;
use HMRC\Test\Request\RequestTestCase;

class HelloApplicationRequestTest extends RequestTestCase
{
    public function testItThrowsExceptionWhenServerTokenIsEmpty()
    {
        $this->expectException(EmptyServerTokenException::class);

        $request = new HelloApplicationRequest();
        $request->fire();
    }

    public function testItCallsCorrectEndpoint()
    {
        // Setup server token
        $serverToken = uniqid();
        $this->setServerToken($serverToken);

        // Setup mocked client
        $container = [];
        $stack = HandlerStack::create(new MockHandler([
            new Response(200),
        ]));
        $stack->push(Middleware::history($container));
        $mockedClient = new Client(['handler' => $stack]);

        // Call the API
        (new HelloApplicationRequest())
            ->setClient($mockedClient)
            ->fire();

        // Asserts
        $this->assertCount(1, $container);

        /** @var Request $guzzleRequest */
        $guzzleRequest = $container[0]['request'];
        $this->assertUri($guzzleRequest);
        $this->assertAuthorizationHeader($guzzleRequest, $serverToken);
        $this->assertAcceptHeader($guzzleRequest);
        $this->assertMethod($guzzleRequest);
    }

    protected function getCorrectPath()
    {
        return '/hello/application';
    }

    protected function getCorrectMethod()
    {
        return RequestMethod::GET;
    }
}
