<?php

namespace BA\ParserBundle\Tests\Process;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProcessFactoryTest extends KernelTestCase
{
    private $processFactory;
    private $container;

    public function setUp()
    {
	self::bootKernel();
        $this->processFactory = static::$kernel->getContainer()->get('parser.process.factory');
        $this->container = static::$kernel->getContainer();
    }
    
    public function testCreateProcess()
    {
        $process = $this->processFactory->createProcess();
        
        $this->assertInstanceOf($this->container->getParameter('parser_process_class'), $process);
    }
    
    public function testGetNameClass()
    {
        $this->assertEquals($this->container->getParameter('parser_process_class'), $this->processFactory->getNameClass());
    }
}