<?php

namespace BA\ParserBundle\Parser;

use Symfony\Component\DependencyInjection\ContainerInterface;
use BA\ParserBundle\Loader\PageInterface;

class ParserFactory
{
    private $container;
    
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    public function createStrategyByPage(PageInterface $page)
    {
        $strategy = $this->container->get($page->getNameStrategy());
        $strategy->setPage($page);
        
        return $strategy;
    }
}
