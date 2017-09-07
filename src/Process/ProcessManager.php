<?php

namespace BA\ParserBundle\Process;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ProcessManager
{
    private $commands = array();
    private $outputProcesses = array();
    
    public function addCommand(ParserCommandInterface $command)
    {
        $this->commands[] = $command;
    }
    
    public function setServiceCommand($serviceCommand)
    {
        $this->serviceCommand = $serviceCommand;
    }
    
    public function removeProcess()
    {
        //
    }
    
    public function killProcess($pid)
    {
        //
    }
    
    public function getOutputResponse()
    {
        return $this->outputProcesses;
    }

    public function runProcesses()
    {
        foreach ($this->processes AS $process) {
            $process->start();       
        }
    }
    
    public function runAsyncProcesses()
    {
        $idx = $this->getIdxNextCommand();
        
        if ($idx !== null) {
            $command = $this->commands[$idx];
            $process = new Process();
            $process->start();
            
            $command->setPid($process->getPid());
            $command->setProcess($process);
            
            $this->commands[$idx] = $command;
            
            while($process->isRunning()) {
                $this->runAsyncProcesses();
            }
            
            $this->outputProcesses[] = $process->getOutput();
        }
    }
    
    private function getIdxNextCommand()
    {
        foreach ($this->commands AS $idx => $command) {
            if ($command->getPid() === 0) {
                return $idx;
            }
        }
    }
}
