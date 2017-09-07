<?php

namespace BA\ParserBundle\Loader\Request;

use BA\ParserBundle\Loader\Request\AbstractRequest;

class RequestPost extends AbstractRequest
{
	protected $type = 'POST';

	public function __construct($url, array $postData)
	{
		$this->url = $url;
		$this->data = http_build_query($postData);
	}
}