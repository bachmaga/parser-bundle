<?php

namespace BA\ParserBundle\Process;

interface ParserCommandInterface
{
    public function getNameCommand();
    public function getPID();
    public function getOutput();
    public function getError();
    public function getProcess();
}
