<?php

namespace BA\ParserBundle\Loader\Request;

use BA\ParserBundle\Loader\Request\RequestGet;

class RequestFactory
{
    public function createPostRequest($url, array $post)
    {
        return new RequestPost($url, $post);
    }

    public function createGetRequest($url)
    {
        return new RequestGet($url);
    }
}