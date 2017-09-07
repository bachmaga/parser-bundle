<?php

namespace BA\ParserBundle\Logger;

use Symfony\Component\DependencyInjection\ContainerInterface;
use BA\ParserBundle\Entity\ParserLog;

class ParserStorageLogs
{
	private $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function isExistError(array $errorData)
	{
		$em = $this->container->get('doctrine.orm.parser_entity_manager');

		$log = $em->getRepository('ParserBundle:ParserLog')->findBy(array(
			'messageId' => $errorData['id'],
			'message'   => $errorData['message'],
			'level'     => $errorData['level']
		));

		return $log ? true : false;
	}

	public function addError(array $errorData)
	{
		$em = $this->container->get('doctrine.orm.parser_entity_manager');

		$log = new ParserLog();

		$log->setMessageId($errorData['id'])
		    ->setMessage($errorData['message'])
		    ->setLevel($errorData['level'])
		    ->setDate($errorData['date']);

		$em->persist($log);
		$em->flush();
	}
}