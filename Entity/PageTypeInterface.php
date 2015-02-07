<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;


/**
 * PageType interface
 */
interface PageTypeInterface
{

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId();

	/**
	 * Set name
	 *
	 * @param string $name
	 *
	 * @return PageTypeInterface
	 */
	public function setName($name);

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName();

	/**
	 * Set description
	 *
	 * @param string $description
	 *
	 * @return PageTypeInterface
	 */
	public function setDescription($description);

	/**
	 * Get description
	 *
	 * @return string
	 */
	public function getDescription();

	/**
	 * Set pageHandler
	 *
	 * @param string $pageHandler
	 *
	 * @return PageTypeInterface
	 */
	public function setPageHandler($pageHandler);

	/**
	 * Get pageHandler
	 *
	 * @return string
	 */
	public function getPageHandler();

	/**
	 * Set template
	 *
	 * @param string $template
	 *
	 * @return PageTypeInterface
	 */
	public function setTemplate($template);

	/**
	 * Get template
	 *
	 * @return string
	 */
	public function getTemplate();

	/**
	 * Set adminForm
	 *
	 * @param string $adminForm
	 *
	 * @return PageTypeInterface
	 */
	public function setAdminForm($adminForm);

	/**
	 * Get adminForm
	 *
	 * @return string
	 */
	public function getAdminForm();

	/**
	 * Set adminTemplate
	 *
	 * @param string $adminTemplate
	 *
	 * @return PageTypeInterface
	 */
	public function setAdminTemplate($adminTemplate);

	/**
	 * Get adminTemplate
	 *
	 * @return string
	 */
	public function getAdminTemplate();

	/**
	 * Set adminFormHandler
	 *
	 * @param string $adminFormHandler
	 *
	 * @return PageTypeInterface
	 */
	public function setAdminFormHandler($adminFormHandler);

	/**
	 * Get adminFormHandler
	 *
	 * @return string
	 */
	public function getAdminFormHandler();

	/**
	 * Set isChild
	 *
	 * @param boolean $isChild
	 *
	 * @return PageTypeInterface
	 */
	public function setIsChild($isChild);

	/**
	 * Get isChild
	 *
	 * @return boolean
	 */
	public function getIsChild();

	/**
	 * Set hasChildren
	 *
	 * @param boolean $hasChildren
	 *
	 * @return PageTypeInterface
	 */
	public function setHasChildren($hasChildren);

	/**
	 * Get hasChildren
	 *
	 * @return boolean
	 */
	public function getHasChildren();

	/**
	 * Set childrenOrderBy
	 *
	 * @param string $childrenOrderBy
	 *
	 * @return PageTypeInterface
	 */
	public function setChildrenOrderBy($childrenOrderBy);

	/**
	 * Get childrenOrderBy
	 *
	 * @return string
	 */
	public function getChildrenOrderBy();

	/**
	 * Set childrenOrderDirection
	 *
	 * @param string $childrenOrderDirection
	 *
	 * @return PageTypeInterface
	 */
	public function setChildrenOrderDirection($childrenOrderDirection);

	/**
	 * Get childrenOrderDirection
	 *
	 * @return string
	 */
	public function getChildrenOrderDirection();

	/**
	 * Set hasFiles
	 *
	 * @param boolean $hasFiles
	 *
	 * @return PageTypeInterface
	 */
	public function setHasFiles($hasFiles);

	/**
	 * Get hasFiles
	 *
	 * @return boolean
	 */
	public function getHasFiles();

	/**
	 * Set hasContent
	 *
	 * @param boolean $hasContent
	 *
	 * @return PageTypeInterface
	 */
	public function setHasContent($hasContent);

	/**
	 * Get hasContent
	 *
	 * @return boolean
	 */
	public function getHasContent();

	/**
	 * Add pageTypeParent
	 *
	 * @param PageTypeInterface $pageTypeParent
	 *
	 * @return PageType
	 */
	public function addPageTypeParent(PageTypeInterface $pageTypeParent);

	/**
	 * Remove pageTypeParent
	 *
	 * @param PageTypeInterface $pageTypeParent
	 */
	public function removePageTypeParent(PageTypeInterface $pageTypeParent);

	/**
	 * Get pageTypeParents
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getPageTypeParents();

	/**
	 * Add pageTypeChild
	 *
	 * @param PageTypeInterface $pageTypeChild
	 *
	 * @return PageTypeInterface
	 */
	public function addPageTypeChild(PageTypeInterface $pageTypeChild);

	/**
	 * Remove pageTypeChild
	 *
	 * @param PageTypeInterface $pageTypeChild
	 */
	public function removePageTypeChild(PageTypeInterface $pageTypeChild);

	/**
	 * Get pageTypeChildren
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getPageTypeChildren();

	/**
	 * Set roles
	 *
	 * @param array $roles
	 *
	 * @return PageTypeInterface
	 */
	public function setRoles(array $roles);

	/**
	 * Get roles
	 *
	 * @return array
	 */
	public function getRoles();

	/**
	 * Is the given user granted to use this PageType
	 *
	 * @param \Symfony\Component\Security\Core\User\UserInterface $user
	 *
	 * @return boolean
	 */
	public function isUserGranted(\Symfony\Component\Security\Core\User\UserInterface $user);

	/**
	 * PageType name
	 *
	 * @return string
	 */
	public function __toString();
}
