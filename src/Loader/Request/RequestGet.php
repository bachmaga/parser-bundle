<?php

namespace BA\ParserBundle\Loader\Request;

use BA\ParserBundle\Loader\Request\AbstractRequest;

class RequestGet extends AbstractRequest
{
	protected $type = 'GET';

	public function __construct($url)
	{
		$this->url = $url;
	}
}