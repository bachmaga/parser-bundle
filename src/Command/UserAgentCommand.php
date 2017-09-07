<?php

namespace BA\ParserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UserAgentCommand extends ContainerAwareCommand
{
    protected function configure()
    {
            $this->setName('parser:request:user_agent')
                 ->setDescription('Search dates')
                 ->addArgument('action', InputArgument::REQUIRED, 'insert action');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getArgument('action') == 'import') {
            $root =   $this->getContainer()->get('kernel')->getRootDir();
            $web = realpath($root.'/../web');
            
            $listStringUserAgent = explode("\r\n", file_get_contents($web.'/user_agent_list.txt')); 
            $uAgentList = array();
            foreach ($listStringUserAgent AS $name) {
                $uAgentList[] = $name;
            }
            
            $this->getContainer()->get('parser.user_agent_storage')->saveList($uAgentList);
        }
    }
}