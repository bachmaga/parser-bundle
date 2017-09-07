<?php

namespace BA\ParserBundle\Tests\Loader\Response;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use BA\ParserBundle\Loader\Request\RequestInterface;

class ResponseHandlerTest extends KernelTestCase
{
    private $responseHandler;

    public function setUp()
    {
	self::bootKernel();
        $this->responseHandler = static::$kernel->getContainer()->get('parser.response_handler');
    }

    public function testConvertToResponseFromString()
    {	
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.ru');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        
        $result = curl_exec($ch);
        curl_close($ch);
        
        $response = $this->responseHandler->convertToResponseFromString($result);

	$this->assertInstanceOf("BA\ParserBundle\Loader\Response\Response", $response);
	$this->assertEquals(200, $response->getStatus());
    }
}