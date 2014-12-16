<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;


/**
 * User
 */
class User extends BaseUser
{

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}

}
