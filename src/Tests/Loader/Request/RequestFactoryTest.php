<?php

namespace BA\ParserBundle\Tests\Loader\Request;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RequestFactoryTest extends KernelTestCase
{
    private $requestFactory;

    public function setUp()
    {
        self::bootKernel();
        $this->requestFactory = static::$kernel->getContainer()->get('parser.request_factory');
    }

    public function testCreateGetRequest()
    {
        $request = $this->requestFactory->createGetRequest('https:google.com');

        $this->assertInstanceOf("BA\ParserBundle\Loader\Request\RequestGet", $request);
        $this->assertEquals('GET', $request->getType());
    }

    public function testCreatePostRequest()
    {
        $postData = array('foo' => 'bar', 'bar' => 'foo');
        $request  = $this->requestFactory->createPostRequest('https:google.com', $postData);

        $this->assertInstanceOf("BA\ParserBundle\Loader\Request\RequestPost", $request);
        $this->assertEquals('POST', $request->getType());
        $this->assertEquals('foo=bar&bar=foo', $request->getData());
    }
}