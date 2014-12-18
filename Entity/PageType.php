<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * PageType
 */
class PageType
{

	/**
	 * @var string
	 */
	private $id;

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var string
	 */
	private $description;

	/**
	 * @var string
	 */
	private $pageHandler;

	/**
	 * @var string
	 */
	private $template;

	/**
	 * @var string
	 */
	private $adminForm;

	/**
	 * @var string
	 */
	private $adminTemplate;

	/**
	 * @var string
	 */
	private $adminFormHandler;

	/**
	 * @var boolean
	 */
	private $isChild;

	/**
	 * @var boolean
	 */
	private $hasChildren;

	/**
	 * @var string
	 */
	private $childrenOrderBy;

	/**
	 * @var string
	 */
	private $childrenOrderDirection;

	/**
	 * @var boolean
	 */
	private $hasFiles;

	/**
	 * @var boolean
	 */
	private $hasContent;

	/**
	 * @var Collection
	 */
	private $pages;

	/**
	 * @var Collection
	 */
	private $pageTypeParents;

	/**
	 * @var Collection
	 */
	private $pageTypeChildren;

	/**
	 * @var array
	 */
	private $roles;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->pages = new ArrayCollection();
		$this->pageTypeParents = new ArrayCollection();
		$this->pageTypeChildren = new ArrayCollection();
	}

	/**
	 * Get id
	 *
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set name
	 *
	 * @param string $name
	 *
	 * @return PageType
	 */
	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set description
	 *
	 * @param string $description
	 *
	 * @return PageType
	 */
	public function setDescription($description)
	{
		$this->description = $description;

		return $this;
	}

	/**
	 * Get description
	 *
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Set pageHandler
	 *
	 * @param string $pageHandler
	 *
	 * @return PageType
	 */
	public function setPageHandler($pageHandler)
	{
		$this->pageHandler = $pageHandler;

		return $this;
	}

	/**
	 * Get pageHandler
	 *
	 * @return string
	 */
	public function getPageHandler()
	{
		return $this->pageHandler;
	}

	/**
	 * Set template
	 *
	 * @param string $template
	 *
	 * @return PageType
	 */
	public function setTemplate($template)
	{
		$this->template = $template;

		return $this;
	}

	/**
	 * Get template
	 *
	 * @return string
	 */
	public function getTemplate()
	{
		return $this->template;
	}

	/**
	 * Set adminForm
	 *
	 * @param string $adminForm
	 *
	 * @return PageType
	 */
	public function setAdminForm($adminForm)
	{
		$this->adminForm = $adminForm;

		return $this;
	}

	/**
	 * Get adminForm
	 *
	 * @return string
	 */
	public function getAdminForm()
	{
		return $this->adminForm;
	}

	/**
	 * Set adminTemplate
	 *
	 * @param string $adminTemplate
	 *
	 * @return PageType
	 */
	public function setAdminTemplate($adminTemplate)
	{
		$this->adminTemplate = $adminTemplate;

		return $this;
	}

	/**
	 * Get adminTemplate
	 *
	 * @return string
	 */
	public function getAdminTemplate()
	{
		return $this->adminTemplate;
	}

	/**
	 * Set adminFormHandler
	 *
	 * @param string $adminFormHandler
	 *
	 * @return PageType
	 */
	public function setAdminFormHandler($adminFormHandler)
	{
		$this->adminFormHandler = $adminFormHandler;

		return $this;
	}

	/**
	 * Get adminFormHandler
	 *
	 * @return string
	 */
	public function getAdminFormHandler()
	{
		return $this->adminFormHandler;
	}

	/**
	 * Set isChild
	 *
	 * @param boolean $isChild
	 *
	 * @return PageType
	 */
	public function setIsChild($isChild)
	{
		$this->isChild = $isChild;

		return $this;
	}

	/**
	 * Get isChild
	 *
	 * @return boolean
	 */
	public function getIsChild()
	{
		return $this->isChild;
	}

	/**
	 * Set hasChildren
	 *
	 * @param boolean $hasChildren
	 *
	 * @return PageType
	 */
	public function setHasChildren($hasChildren)
	{
		$this->hasChildren = $hasChildren;

		return $this;
	}

	/**
	 * Get hasChildren
	 *
	 * @return boolean
	 */
	public function getHasChildren()
	{
		return $this->hasChildren;
	}

	/**
	 * Set childrenOrderBy
	 *
	 * @param string $childrenOrderBy
	 *
	 * @return PageType
	 */
	public function setChildrenOrderBy($childrenOrderBy)
	{
		$this->childrenOrderBy = $childrenOrderBy;

		return $this;
	}

	/**
	 * Get childrenOrderBy
	 *
	 * @return string
	 */
	public function getChildrenOrderBy()
	{
		return $this->childrenOrderBy;
	}

	/**
	 * Set childrenOrderDirection
	 *
	 * @param string $childrenOrderDirection
	 *
	 * @return PageType
	 */
	public function setChildrenOrderDirection($childrenOrderDirection)
	{
		$this->childrenOrderDirection = $childrenOrderDirection;

		return $this;
	}

	/**
	 * Get childrenOrderDirection
	 *
	 * @return string
	 */
	public function getChildrenOrderDirection()
	{
		return $this->childrenOrderDirection;
	}

	/**
	 * Set hasFiles
	 *
	 * @param boolean $hasFiles
	 *
	 * @return PageType
	 */
	public function setHasFiles($hasFiles)
	{
		$this->hasFiles = $hasFiles;

		return $this;
	}

	/**
	 * Get hasFiles
	 *
	 * @return boolean
	 */
	public function getHasFiles()
	{
		return $this->hasFiles;
	}

	/**
	 * Set hasContent
	 *
	 * @param boolean $hasContent
	 *
	 * @return PageType
	 */
	public function setHasContent($hasContent)
	{
		$this->hasContent = $hasContent;

		return $this;
	}

	/**
	 * Get hasContent
	 *
	 * @return boolean
	 */
	public function getHasContent()
	{
		return $this->hasContent;
	}

	/**
	 * Add page
	 *
	 * @param Page $page
	 *
	 * @return PageType
	 */
	public function addPage(Page $page)
	{
		$this->pages[] = $page;

		return $this;
	}

	/**
	 * Remove page
	 *
	 * @param Page $page
	 */
	public function removePage(Page $page)
	{
		$this->pages->removeElement($page);
	}

	/**
	 * Get pages
	 *
	 * @return Collection
	 */
	public function getPages()
	{
		return $this->pages;
	}

	/**
	 * Add pageTypeParent
	 *
	 * @param PageType $pageTypeParent
	 *
	 * @return PageType
	 */
	public function addPageTypeParent(PageType $pageTypeParent)
	{
		$this->pageTypeParents[] = $pageTypeParent;

		return $this;
	}

	/**
	 * Remove pageTypeParent
	 *
	 * @param PageType $pageTypeParent
	 */
	public function removePageTypeParent(PageType $pageTypeParent)
	{
		$this->pageTypeParents->removeElement($pageTypeParent);
	}

	/**
	 * Get pageTypeParents
	 *
	 * @return Collection
	 */
	public function getPageTypeParents()
	{
		return $this->pageTypeParents;
	}

	/**
	 * Add pageTypeChild
	 *
	 * @param PageType $pageTypeChild
	 *
	 * @return PageType
	 */
	public function addPageTypeChild(PageType $pageTypeChild)
	{
		$this->pageTypeChildren[] = $pageTypeChild;

		return $this;
	}

	/**
	 * Remove pageTypeChild
	 *
	 * @param PageType $pageTypeChild
	 */
	public function removePageTypeChild(PageType $pageTypeChild)
	{
		$this->pageTypeChildren->removeElement($pageTypeChild);
	}

	/**
	 * Get pageTypeChildren
	 *
	 * @return Collection
	 */
	public function getPageTypeChildren()
	{
		return $this->pageTypeChildren;
	}

	/**
	 * Set roles
	 *
	 * @param array $roles
	 *
	 * @return PageType
	 */
	public function setRoles(array $roles)
	{
		$this->roles = $roles;

		return $this;
	}

	/**
	 * Get roles
	 *
	 * @return array
	 */
	public function getRoles()
	{
		return $this->roles;
	}

	/**
	 * Is the given user granted to use this PageType
	 *
	 * @param UserInterface $user
	 *
	 * @return boolean
	 */
	public function isUserGranted(UserInterface $user)
	{
		if (0 === count($this->roles)) {
			return true;
		}

		$userRoles = $user->getRoles();

		foreach ($this->roles as $role) {
			if (in_array($role, $userRoles)) {
				return true;
			}
		}

		return false;
	}

	/**
	 * PageType name
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->name;
	}

}
