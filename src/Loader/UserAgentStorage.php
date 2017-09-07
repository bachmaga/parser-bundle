<?php

namespace BA\ParserBundle\Loader;

use Doctrine\ORM\EntityManager;

class UserAgentStorage
{
    private $em;
    
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    public function saveList(array $list)
    {
        foreach ($list AS $loopUserAgent) {
            $userAgent = $this->em->getRepository('ParserBundle:UserAgent')->create();
            $userAgent->setName($loopUserAgent);
            
            $this->em->persist($userAgent);
        }
        
        $this->em->flush();
    }
    
    public function getRandomUserAgent()
    {
        $countResult = $this->em->createQuery('SELECT count(ua.id) AS cnt FROM ParserBundle:UserAgent AS ua')
                                ->getResult();
        
        $count = $countResult[0]['cnt'];
        $id = mt_rand(1, $count);
        
        return $this->em->getRepository('ParserBundle:UserAgent')->findOneById($id);
    }
}