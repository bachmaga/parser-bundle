<?php

namespace BA\ParserBundle\Parser;

use Psr\Log\LoggerInterface;
use BA\ParserBundle\Parser\ParserFactory;

class ParserManager
{
    private $logger;
    private $parserFactory;
    
    public function __construct(LoggerInterface $logger, ParserFactory $parserFactory)
    {
        $this->logger = $logger;
    }
    
    public function parse(PageInterface $page)
    {
        $result = array();
        
        try {
            $parserStrategy = $this->parserFactory->createStrategyByPage($page);

            $result = $parserStrategy->find();
        } catch (\Exception $ex) {
        }
        
        return $result;
    }
}
