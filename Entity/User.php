<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;


/**
 * User
 */
abstract class User implements UserInterface
{

	protected $id;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * {@inheritDoc}
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getKRCMSUsername()
	{
		return $this->email;
	}

}
