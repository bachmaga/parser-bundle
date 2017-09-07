<?php

namespace BA\ParserBundle\Entity;

use BA\ParserBundle\Loader\Proxy\ProxyInterface;

/**
 * Proxy
 */
class Proxy implements ProxyInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $port;

    /**
     * @var string
     */
    private $address;

    /**
     * @var \DateTime
     */
    private $timeLastCheckUpdate;
    
    /**
     * @var string
     */
    private $note;
    
    /**
     * @var boolean
     */
    private $isWorking;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $uses;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->uses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function getUID()
    {
        return $this->id;
    }

    /**
     * Set port
     *
     * @param string $port
     *
     * @return Proxy
     */
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * Get port
     *
     * @return string
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Proxy
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set timeLastCheckUpdate
     *
     * @param \DateTime $timeLastCheckUpdate
     *
     * @return Proxy
     */
    public function setTimeLastCheckUpdate($timeLastCheckUpdate)
    {
        $this->timeLastCheckUpdate = $timeLastCheckUpdate;

        return $this;
    }

    /**
     * Get timeLastCheckUpdate
     *
     * @return \DateTime
     */
    public function getTimeLastCheckUpdate()
    {
        return $this->timeLastCheckUpdate;
    }
    
    /**
     * Set note
     *
     * @param string $note
     *
     * @return Proxy
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }
    
    /**
     * Set isWokring
     *
     * @param boolean $isWorking
     *
     * @return Proxy
     */
    public function setIsWorking($isWorking)
    {
        $this->isWorking = $isWorking;

        return $this;
    }

    /**
     * Get isWorking
     *
     * @return boolean
     */
    public function getIsWorking()
    {
        return $this->isWorking;
    }
    
    /**
     * Add use
     *
     * @param \BA\ProxyUse\Entity\ProxyUse $use
     *
     * @return Event
     */
    public function addUse(\BA\ParserBundle\Entity\ProxyUse $use)
    {
        $this->uses[] = $use;

        return $this;
    }

    /**
     * Remove use
     *
     * @param \Ba\ParserBundle\Entity\ProxyUse $use
     */
    public function removeUse(\BA\ParserBundle\Entity\ProxyUse $use)
    {
        $this->dates->removeElement($use);
    }

    /**
     * Get dates
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUses()
    {
        return $this->uses;
    }
}

