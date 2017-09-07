<?php

namespace BA\ParserBundle\Loader\Proxy;

interface ProxyInterface
{
    public function getUID();
    public function getPort();
    public function getAddress();
    public function getTimeLastCheckUpdate();
}
