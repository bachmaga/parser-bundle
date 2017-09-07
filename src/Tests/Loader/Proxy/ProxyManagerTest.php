<?php

namespace BA\ParserBundle\Tests\Loader\Proxy;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProxyManagerTest extends KernelTestCase
{
    private $proxyManager;

    public function setUp()
    {
	self::bootKernel();
        $this->proxyManager = static::$kernel->getContainer()->get('parser.proxy.proxy_manager');
    }
    
    public function testImportListProxy()
    {
        $root =  static::$kernel->getRootDir();
        $web = realpath($root.'/../web');
        
        //import 10 proxy from file
        $result = $this->proxyManager->importListProxy($web.'/proxy_list_test.txt');
        
        $this->assertInternalType('array', $result);
        $this->assertEquals(10, count($result));
    }
    
    public function testSaveProxyList()
    {
        $proxyList = array(
            array('address' => '193.193.230.211', 'port' => '1080','note' => 'test'),
            array('address' => '62.182.51.114', 'port' => '1080','note' => 'test'),
        );
        
        $this->assertTrue($this->proxyManager->saveProxyList($proxyList));
    }
    
    public function testGetNextProxy()
    {
        $proxy = $this->proxyManager->getNextProxy();
        
        $this->assertInstanceOf("BA\ParserBundle\Loader\Proxy\ProxyInterface", $proxy);
    }
    
    public function testCheckProxy()
    {
        $proxy = $this->proxyManager->getNextProxy();
        
        $this->assertInternalType('boolean', $this->proxyManager->checkProxy($proxy));
    }
    
    public function testDoBlockProxyByContext()
    {
        $proxy = $this->proxyManager->getNextProxyByContext('test');
        $proxy = $this->proxyManager->doBlockProxyByContext($proxy, 'test');
        
        $use = null;
        foreach ($proxy->getUses() AS $loopUse) {
            if ($loopUse->getContext() == 'test') {
                $use = $loopUse;
            }
        }
        
        $this->assertTrue($use->getBlocked());
    }
}
