<?php

namespace BA\ParserBundle\Loader\Proxy;

use BA\ParserBundle\Loader\Proxy\DBProxyStorage;
use BA\ParserBundle\Loader\Proxy\ProxyInterface;

class ProxyManager
{
    private $proxyStorage;
    
    public function __construct(DBProxyStorage $proxyStorage)
    {
        $this->proxyStorage = $proxyStorage;
    }
    
    public function importListProxy($filename)
    {
        $listStringProxy = explode("\r\n", file_get_contents($filename));
        
        $responseProxyList = array();
        
        foreach ($listStringProxy AS $stringProxy) {
            $paramAddress = explode(':', $stringProxy);
            $responseProxyList[] = array(
                'address' => $paramAddress[0],
                'port' => $paramAddress[1],
                'note' => 'import'
            );
        }
        
        return $responseProxyList;
    }
    
    public function saveProxyList(array $proxyList)
    {
        $this->proxyStorage->saveProxyList($proxyList);
            
        return true;
    }
    
    public function checkProxy(ProxyInterface $proxy)
    {
        $secondsInHour = 3600;
        if ($proxy->getTimeLastCheckUpdate() && (time() - $proxy->getTimeLastCheckUpdate()->getTimestamp() < $secondsInHour)) {
            return true;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://google.ru');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_PROXY, $proxy->getAddress().':'.$proxy->getPort());
        curl_setopt($ch, CURLOPT_HEADER, 0);

        if (curl_exec($ch) === false) {
            $checkResult = false;
        } else {
            $checkResult = true;
        }

        curl_close($ch);
        
        return $checkResult;
    }
    
    public function getNextProxy()
    {
        $proxy = $this->proxyStorage->getProxy();

        if ($proxy === null) {
            throw new \Exception('Proxy list ended');
        }
        
        if (!$this->checkProxy($proxy)) {
            $proxy->setIsWorking(false);
            $this->proxyStorage->updateProxy($proxy);
            
            $proxy = $this->getNextProxy();
        }
        
        return $proxy;
    }
    
    public function getNextProxyByContext($contextSubject)
    {
        $proxy = $this->proxyStorage->getProxyByContext($contextSubject);

        if ($proxy === null) {
            throw new \Exception('Proxy list ended');
        }
        
        if (!$this->checkProxy($proxy)) {
            $proxy->setIsWorking(false);
            $this->proxyStorage->updateProxy($proxy);
            
            $proxy = $this->getNextProxyByContext($contextSubject);
        }
        
        return $proxy;
    }
    
    public function doBlockProxyByContext(ProxyInterface $proxy, $context)
    {
        $use = null;
        foreach ($proxy->getUses() AS $loopUse) {
            if ($loopUse->getContext() == $context) {
                $use = $loopUse;
            }
        }
        
        if ($use == null) {
            $use = $this->proxyStorage->createNewUse();
        }
        
        $use->setProxy($proxy);
        $use->setBlocked(true);
        $use->setContext($context);
        $use->setDateReuse(new \Datetime(date('d.m.Y H:i:s', time())));
        
        $proxy->addUse($use);
        
        $this->proxyStorage->updateProxy($proxy);
        
        return $proxy;
    }
    
    public function updateDateReuseOfProxy(ProxyInterface $proxy, $minets)
    {
        $dateReuse = new \Datetime(date('d.m.Y H:i:s', time() + ($minets * 60)));
        $proxy->setDateReuse($dateReuse);
        
        $this->proxyStorage->updateProxy($proxy);
    }
}
