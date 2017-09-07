<?php

namespace BA\ParserBundle\Loader\Proxy;

use BA\ParserBundle\Loader\Proxy\ProxyInterface;
use Doctrine\ORM\EntityManager;

class DBProxyStorage
{
    private $em;
    private $idOfLastReceivedProxy = 0;
    
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    public function createNewUse()
    {
        return $this->em->getRepository('ParserBundle:ProxyUse')->create();
    }
    
    public function getProxy()
    {
        $proxy = $this->em->createQuery('SELECT proxy FROM ParserBundle:Proxy AS proxy WHERE proxy.id > :id AND proxy.isWorking = 1')
                          ->setParameter('id', $this->idOfLastReceivedProxy)
                          ->setMaxResults(1)
                          ->getOneOrNullResult();
        
        if ($proxy) {
            $this->idOfLastReceivedProxy = $proxy->getId();
        }
        
        return $proxy;
    }
    
    public function getProxyByContext($contextSubject)
    {
        $sql = "SELECT proxy FROM ParserBundle:Proxy AS proxy LEFT JOIN proxy.uses AS use WHERE proxy.id > :id AND proxy.isWorking = 1 "
                . "AND ((use.context = :context AND use.dateReuse < CURRENT_TIMESTAMP() AND use.blocked = 0) OR (use.context is null AND use.dateReuse is null))";
        
        $proxy = $this->em->createQuery($sql)
                          ->setParameter('context', $contextSubject)
                          ->setParameter('id', $this->idOfLastReceivedProxy)
                          ->setMaxResults(1)
                          ->getOneOrNullResult();
        
        if ($proxy) {
            $this->idOfLastReceivedProxy = $proxy->getId();
        }
        
        return $proxy;
    }
    
    public function saveProxyList(array $proxyList)
    {
        foreach ($proxyList AS $item) {
            $proxy = $this->em->getRepository('ParserBundle:Proxy')->create();
            
            $proxy->setNote($item['note']);
            $proxy->setPort($item['port']);
            $proxy->setIsWorking(true);
            $proxy->setAddress($item['address']);
            
            $this->em->persist($proxy);
        }
        
        $this->em->flush();
    }
    
    public function updateProxy(ProxyInterface $proxy)
    {
        foreach ($proxy->getUses() AS $use) {
            $this->em->persist($use);
        }
        
        $this->em->persist($proxy);
        $this->em->flush();
    }
}
