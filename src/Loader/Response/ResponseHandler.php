<?php

namespace BA\ParserBundle\Loader\Response;

use Symfony\Component\DomCrawler\Crawler;
use BA\ParserBundle\Loader\Response\Response;

class ResponseHandler
{
    public function convertToResponseFromString($responseString)
    {
        $crawler = new Crawler($responseString);
        $content = $crawler->filter('html')->html();
        $headersString = substr($responseString, 0, strrpos($responseString, "\r\n\r\n"));
        $headers = array();
        
        foreach(explode("\r\n", $headersString) as $header) {
            $headers[] = $header;
        }
        
        preg_match('/(\s[\d]{3}\s)/', $headers[0], $matchStatus);
        $status = (int)$matchStatus[0];

        return new Response($status, $content, $headers);
    }
}
