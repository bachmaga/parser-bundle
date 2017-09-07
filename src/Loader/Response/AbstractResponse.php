<?php

namespace BA\ParserBundle\Loader\Response;

use BA\ParserBundle\Loader\Response\ResponseInterface;

abstract class AbstractResponse implements ResponseInterface
{
    protected $content;
    protected $status;
    protected $headers = array();

    public function getContent()
    {
        return $this->content;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getHeaders()
    {
        return $this->headers;
    }
}