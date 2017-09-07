<?php

namespace BA\ParserBundle\Loader;

use BA\ParserBundle\Loader\Request\RequestInterface;
use BA\ParserBundle\Loader\Response\ResponseHandler;
use BA\ParserBundle\Loader\Proxy\ProxyManager;
use BA\ParserBundle\Loader\Proxy\ProxyInterface;

class PageLoader
{
    private $responseHandler;
    
    public function __construct(ResponseHandler $responseHandler)
    {
        $this->responseHandler = $responseHandler;
    }

    public function initCurlWithCommonOptions(RequestInterface $request)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request->getUrl());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $request->getHeaders());
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	
        return $ch;
    }

    public function loadByGetRequest(RequestInterface $request)
    {
	$ch = $this->initCurlWithCommonOptions($request);
        
        if ($request->getSsl()) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }
        curl_setopt($ch, CURLOPT_HEADER, 1);
        
        $result = curl_exec($ch);
        curl_close($ch);
        
        return $this->responseHandler->convertToResponseFromString($result);
    }

    public function loadByGetRequestAndProxy(RequestInterface $request, ProxyInterface $proxy)
    {
        $ch = $this->initCurlWithCommonOptions($request);

        if ($request->getSsl()) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }
        curl_setopt($ch, CURLOPT_PROXY, $proxy->getAddress().':'.$proxy->getPort());
        curl_setopt($ch, CURLOPT_HEADER, 1);

        $result = curl_exec($ch);
        curl_close($ch);

        return $this->responseHandler->convertToResponseFromString($result);
    }
}