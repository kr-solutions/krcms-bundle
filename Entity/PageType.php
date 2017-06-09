<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * PageType
 */
class PageType implements PageTypeInterface
{

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $pageHandler;

    /**
     * @var string
     */
    protected $template;

    /**
     * @var string
     */
    protected $adminForm;

    /**
     * @var string
     */
    protected $adminTemplate;

    /**
     * @var string
     */
    protected $adminFormHandler;

    /**
     * @var boolean
     */
    protected $isChild;

    /**
     * @var boolean
     */
    protected $isMenuItem;

    /**
     * @var boolean
     */
    protected $hasChildren;

    /**
     * @var string
     */
    protected $childrenOrderBy;

    /**
     * @var string
     */
    protected $childrenOrderDirection;

    /**
     * @var boolean
     */
    protected $hasCategory;

    /**
     * @var boolean
     */
    protected $hasFiles;

    /**
     * @var boolean
     */
    protected $hasHeader;

    /**
     * @var boolean
     */
    protected $hasSlider;

    /**
     * @var boolean
     */
    protected $hasContent;

    /**
     * @var null|int
     */
    protected $maximumToCreate;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $pageTypeParents;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $pageTypeChildren;

    /**
     * @var array
     */
    protected $roles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pageTypeParents = new ArrayCollection();
        $this->pageTypeChildren = new ArrayCollection();

        $this->pageHandler = 'kr_solutions_krcms.page_handler.page';
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
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inheritDoc}
     */
    public function setPageHandler($pageHandler)
    {
        $this->pageHandler = $pageHandler;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getPageHandler()
    {
        return $this->pageHandler;
    }

    /**
     * {@inheritDoc}
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * {@inheritDoc}
     */
    public function setAdminForm($adminForm)
    {
        $this->adminForm = $adminForm;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getAdminForm()
    {
        return $this->adminForm;
    }

    /**
     * {@inheritDoc}
     */
    public function setAdminTemplate($adminTemplate)
    {
        $this->adminTemplate = $adminTemplate;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getAdminTemplate()
    {
        return $this->adminTemplate;
    }

    /**
     * {@inheritDoc}
     */
    public function setAdminFormHandler($adminFormHandler)
    {
        $this->adminFormHandler = $adminFormHandler;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getAdminFormHandler()
    {
        return $this->adminFormHandler;
    }

    /**
     * {@inheritDoc}
     */
    public function setIsChild($isChild)
    {
        $this->isChild = $isChild;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getIsChild()
    {
        return $this->isChild;
    }

    /**
     * {@inheritDoc}
     */
    public function setIsMenuItem($isMenuItem)
    {
        $this->isMenuItem = $isMenuItem;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getIsMenuItem()
    {
        return $this->isMenuItem;
    }

    /**
     * {@inheritDoc}
     */
    public function setHasChildren($hasChildren)
    {
        $this->hasChildren = $hasChildren;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getHasChildren()
    {
        return $this->hasChildren;
    }

    /**
     * {@inheritDoc}
     */
    public function setChildrenOrderBy($childrenOrderBy)
    {
        $this->childrenOrderBy = $childrenOrderBy;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getChildrenOrderBy()
    {
        return $this->childrenOrderBy;
    }

    /**
     * {@inheritDoc}
     */
    public function setChildrenOrderDirection($childrenOrderDirection)
    {
        $this->childrenOrderDirection = $childrenOrderDirection;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getChildrenOrderDirection()
    {
        return $this->childrenOrderDirection;
    }

    /**
     * {@inheritDoc}
     */
    public function setHasCategory($hasCategory)
    {
        $this->hasCategory = $hasCategory;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getHasCategory()
    {
        return $this->hasCategory;
    }

    /**
     * {@inheritDoc}
     */
    public function setHasFiles($hasFiles)
    {
        $this->hasFiles = $hasFiles;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getHasFiles()
    {
        return $this->hasFiles;
    }

    /**
     * {@inheritDoc}
     */
    public function setHasHeader($hasHeader)
    {
        $this->hasHeader = $hasHeader;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getHasHeader()
    {
        return $this->hasHeader;
    }

    /**
     * {@inheritDoc}
     */
    public function getHasSlider()
    {
        return $this->hasSlider;
    }

    /**
     * {@inheritDoc}
     */
    public function setHasSlider($hasSlider)
    {
        $this->hasSlider = $hasSlider;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setHasContent($hasContent)
    {
        $this->hasContent = $hasContent;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getHasContent()
    {
        return $this->hasContent;
    }

    /**
     * {@inheritDoc}
     */
    public function setMaximumToCreate($maximumToCreate = null)
    {
        $this->maximumToCreate = $maximumToCreate;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getMaximumToCreate()
    {
        return $this->maximumToCreate;
    }

    /**
     * {@inheritDoc}
     */
    public function addPageTypeParent(PageTypeInterface $pageTypeParent)
    {
        $this->pageTypeParents[] = $pageTypeParent;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removePageTypeParent(PageTypeInterface $pageTypeParent)
    {
        $this->pageTypeParents->removeElement($pageTypeParent);
    }

    /**
     * {@inheritDoc}
     */
    public function getPageTypeParents()
    {
        return $this->pageTypeParents;
    }

    /**
     * {@inheritDoc}
     */
    public function addPageTypeChild(PageTypeInterface $pageTypeChild)
    {
        $this->pageTypeChildren[] = $pageTypeChild;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removePageTypeChild(PageTypeInterface $pageTypeChild)
    {
        $this->pageTypeChildren->removeElement($pageTypeChild);
    }

    /**
     * {@inheritDoc}
     */
    public function getPageTypeChildren()
    {
        return $this->pageTypeChildren;
    }

    /**
     * {@inheritDoc}
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * {@inheritDoc}
     */
    public function isUserGranted(\Symfony\Component\Security\Core\User\UserInterface $user)
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
     * {@inheritDoc}
     */
    public function __toString()
    {
        return $this->name;
    }
}
