<?php

namespace KRSolutions\Bundle\KRCMSBundle\Model;


/**
 * Abstract page manager
 */
abstract class PageManager implements PageManagerInterface
{

	/**
	 * Constructor
	 */
	public function __construct()
	{
	}

	/**
	 * {@inheritDoc}
	 */
	public function createPage()
	{
		$class = $this->getClass();
		$page = new $class;

		return $page;
	}

}
