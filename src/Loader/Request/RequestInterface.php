<?php

namespace BA\ParserBundle\Loader\Request;

interface RequestInterface
{
    public function setUrl($url);
    public function getUrl();
    public function setHeaders(array $headers);
    public function getHeaders();
}