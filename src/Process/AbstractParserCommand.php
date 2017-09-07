<?php

namespace BA\ParserBundle\Process;

use BA\ParserBundle\Process\ParserCommandInterface;

abstract class AbstractParserCommand implements ParserCommandInterface
{
    protected $pid;
    protected $nameCommand;
    protected $output;
    protected $error;
    protected $process;
    
    abstract public function setNameCommand($nameCommand);
    abstract public function getNameCommand();
    abstract public function setProcess($process);
    abstract public function getProcess();

    public function setPid($pid)
    {
        $this->pid = $pid;
    }
    
    public function getPid()
    {
        return $this->pid;
    }
    
    public function setOutput($output)
    {
        $this->output = $output;
    }
    
    public function getOutput()
    {
        return $this->output;
    }
    
    public function setError($error)
    {
        $this->error = $error;
    }
    
    public function getError()
    {
        return $this->error;
    }
}
