<?php

namespace BA\ParserBundle\Parser;

use BA\ParserBundle\Loader\PageInterface;

interface ParserStrategyInterface
{
    public function find();
    public function setPage(PageInterface $page);
}