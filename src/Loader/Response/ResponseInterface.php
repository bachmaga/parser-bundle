<?php

namespace BA\ParserBundle\Loader\Response;

interface ResponseInterface
{
	public function getStatus();
	public function getContent();
}