<?php

namespace BA\ParserBundle\Loader\Response;

use BA\ParserBundle\Loader\Response\AbstractResponse;

class Response extends AbstractResponse
{
    public function __construct($status, $content, $headers = array())
    {
        $this->status = $status;
        $this->content = $content;
        $this->headers = $headers;
    }
}