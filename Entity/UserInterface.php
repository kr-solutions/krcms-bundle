<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface as BaseUserInterface;


/**
 * User interface
 */
interface UserInterface extends BaseUserInterface
{

	/**
	 * Get username used by KRCMS
	 *
	 * @return string
	 */
	public function getKRCMSUsername();
}
