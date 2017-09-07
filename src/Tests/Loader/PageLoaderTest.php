<?php

namespace BA\ParserBundle\Tests\Loader;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use BA\ParserBundle\Loader\Request\RequestInterface;
use Symfony\Component\DomCrawler\Crawler;

class PageLoaderTest extends KernelTestCase
{
    private $pageLoader;
    private $requestFactory;
    private $proxyManager;

    public function setUp()
    {
	self::bootKernel();
        $this->pageLoader = static::$kernel->getContainer()->get('parser.page_loader');
        $this->proxyManager = static::$kernel->getContainer()->get('parser.proxy.proxy_manager');
        $this->requestFactory = static::$kernel->getContainer()->get('parser.request_factory');
    }
    
    public function testInitCurlWithCommonOptions()
    {
        $reflectionPageLoader = new \ReflectionClass('BA\ParserBundle\Loader\PageLoader');
        
        //open access method of test
        $methodInitCurlWithCommonOptions = $reflectionPageLoader->getMethod('initCurlWithCommonOptions');
        $methodInitCurlWithCommonOptions->setAccessible(true);
 
        $request = $this->requestFactory->createGetRequest('https:google.com');
        $curlDescriptor = $methodInitCurlWithCommonOptions->invoke($this->pageLoader, $request);
        
        $this->assertInternalType("resource", $curlDescriptor);
    }

    public function testLoadByGetRequest()
    {
	$request = $this->requestFactory->createGetRequest('https://www.google.ru');
	$response = $this->pageLoader->loadByGetRequest($request);
        $crawler = new Crawler($response->getContent());

	$this->assertInstanceOf("BA\ParserBundle\Loader\Response\Response", $response);
	$this->assertEquals(200, $response->getStatus());
        $this->assertEquals('Google', $crawler->filter('title')->text());
    }
    
    public function testLoadByGetRequestProxy()
    {
        $request = $this->requestFactory->createGetRequest('https://www.google.ru');
        $proxy = $this->proxyManager->getNextProxy();
        
        $response = $this->pageLoader->loadByGetRequestByProxy($request, $proxy);
	$this->assertInstanceOf("BA\ParserBundle\Loader\Response\Response", $response);
	$this->assertEquals(200, $response->getStatus());
        
        $crawler = new Crawler($response->getContent());
        $this->assertEquals('Google', $crawler->filter('title')->text());
    }
}