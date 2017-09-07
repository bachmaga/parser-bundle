<?php

namespace BA\ParserBundle\Parser;

class ParserContext
{
    private $strategies = array();
    
    public function addStrategy($alias, ParserStrategyInterface $parserStrategy)
    {
        $this->strategies[$alias] = $parserStrategy;
    }
    
    public function execute()
    {
        
    }
}
