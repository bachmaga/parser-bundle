<?php

namespace BA\ParserBundle\Loader\Request;

use BA\ParserBundle\Loader\Request\RequestInterface;

abstract class AbstractRequest implements RequestInterface
{
    protected $type;
    protected $data;
    protected $url;
    protected $ssl = false;
    protected $proxy = false;
    protected $headers = array();

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getType()
    {
        return $this->type;
    }
    
    public function setSsl($ssl)
    {
        $this->ssl = $ssl;
    }

    public function getSsl()
    {
        return $this->ssl;
    }

    public function getProxy()
    {
        return $this->proxy;
    }
    
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    public function getHeaders()
    {
        return $this->headers;
    }
}