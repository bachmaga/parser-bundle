<?php

namespace BA\ParserBundle\Entity;

/**
 * ProxyUse
 */
class ProxyUse
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $context;

    /**
     * @var \DateTime
     */
    private $dateReuse;
    
    /**
     * @var boolean
     */
    private $blocked;
    
    /**
     * @var \BA\ParserBundle\Entity\Proxy
     */
    private $proxy;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set context
     *
     * @param string $context
     *
     * @return ProxyUse
     */
    public function setContext($context)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * Get context
     *
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Set dateReuse
     *
     * @param \DateTime $dateReuse
     *
     * @return ProxyUse
     */
    public function setDateReuse($dateReuse)
    {
        $this->dateReuse = $dateReuse;

        return $this;
    }

    /**
     * Get dateReuse
     *
     * @return \DateTime
     */
    public function getDateReuse()
    {
        return $this->dateReuse;
    }
    
    /**
     * Set blocked
     *
     * @param boolean $blocked
     *
     * @return ProxyUse
     */
    public function setBlocked($blocked)
    {
        $this->blocked = $blocked;

        return $this;
    }

    /**
     * Get blocked
     *
     * @return boolean
     */
    public function getBlocked()
    {
        return $this->blocked;
    }
    
    /**
     * Set proxy
     *
     * @param \BA\ParserBundle\Entity\Proxy $proxy
     *
     * @return ProxyUse
     */
    public function setProxy(\BA\ParserBundle\Entity\Proxy $proxy = null)
    {
        $this->proxy = $proxy;

        return $this;
    }

    /**
     * Get proxy
     *
     * @return \BA\ParserBundle\Entity\Proxy
     */
    public function getProxy()
    {
        return $this->proxy;
    }
}

