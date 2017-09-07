<?php

namespace BA\ParserBundle\Process;

class ProcessFactory
{
    private $nameClass;
    
    public function __construct($nameClass)
    {
        $this->nameClass = $nameClass;
    }
    
    public function createProcess()
    {        
        return new $this->nameClass();
    }
    
    public function getNameClass()
    {
        return $this->nameClass;
    }
}
