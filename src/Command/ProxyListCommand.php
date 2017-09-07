<?php

namespace BA\ParserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ProxyListCommand extends ContainerAwareCommand
{
    protected function configure()
    {
            $this->setName('parser:proxy:list')
                 ->setDescription('Search dates')
                 ->addArgument('action', InputArgument::REQUIRED, 'insert action');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getArgument('action') == 'import') {
            $root =   $this->getContainer()->get('kernel')->getRootDir();
            $web = realpath($root.'/../web');

            $list = $this->getContainer()->get('parser.proxy.proxy_manager')->importListProxy($web.'/proxy_list.txt');
            $this->getContainer()->get('parser.proxy.proxy_manager')->saveProxyList($list);
        }
    }
}