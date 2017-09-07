<?php

namespace BA\ParserBundle\Process;

use BA\ParserBundle\Process\AbstractParserCommand;
use Symfony\Component\Process\Process;

class ParserCommand extends AbstractParserCommand
{    
    public function setProcess(Process $process)
    {
        $this->process = $process;
    }
    
    public function getProcess()
    {
        return $this->process;
    }
    
    public function setNameCommand($nameCommand)
    {
        $this->nameCommand = $nameCommand;
    }
    
    public function getNameCommand()
    {
        return $this->nameCommand;
    }
}
