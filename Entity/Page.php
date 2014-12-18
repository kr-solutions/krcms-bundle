<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use KRSolutions\Bundle\KRUserBundle\Entity\User;


/**
 * Page
 */
class Page
{

	/**
	 * @var integer
	 */
	private $id;

	/**
	 * @var integer
	 */
	private $orderId;

	/**
	 * @var DateTime
	 */
	private $createdAt;

	/**
	 * @var DateTime
	 */
	private $updatedAt;

	/**
	 * @var DateTime
	 */
	private $publishAt;

	/**
	 * @var DateTime
	 */
	private $publishTill;

	/**
	 * @var string
	 */
	private $permalink;

	/**
	 * @var string
	 */
	private $menuTitle;

	/**
	 * @var string
	 */
	private $title;

	/**
	 * @var string
	 */
	private $content;

	/**
	 * @var string
	 */
	private $metaKeywords;

	/**
	 * @var string
	 */
	private $metaDescription;

	/**
	 * @var Collection
	 */
	private $pages;

	/**
	 * @var Collection
	 */
	private $files;

	/**
	 * @var Menu
	 */
	private $menu;

	/**
	 * @var Site
	 */
	private $site;

	/**
	 * @var User
	 */
	private $createdBy;

	/**
	 * @var User
	 */
	private $updatedBy;

	/**
	 * @var PageType
	 */
	private $pageType;

	/**
	 * @var Page
	 */
	private $parent;

	/**
	 * @var Collection
	 */
	private $categories;

	/**
	 * @var Collection
	 */
	private $tags;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->pages = new ArrayCollection();
		$this->files = new ArrayCollection();
		$this->categories = new ArrayCollection();
		$this->tags = new ArrayCollection();

		$this->createdAt = new \DateTime('now');
		$this->updatedAt = new \DateTime('now');
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

	/**
	 * Set orderId
	 *
	 * @param integer $orderId
	 *
	 * @return Page
	 */
	public function setOrderId($orderId)
	{
		$this->orderId = $orderId;

		return $this;
	}

	/**
	 * Get orderId
	 *
	 * @return integer
	 */
	public function getOrderId()
	{
		return $this->orderId;
	}

	/**
	 * Set createdAt
	 *
	 * @param DateTime $createdAt
	 *
	 * @return Page
	 */
	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;

		return $this;
	}

	/**
	 * Get createdAt
	 *
	 * @return DateTime
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	/**
	 * Set updatedAt
	 *
	 * @param DateTime $updatedAt
	 *
	 * @return Page
	 */
	public function setUpdatedAt($updatedAt)
	{
		$this->updatedAt = $updatedAt;

		return $this;
	}

	/**
	 * Get updatedAt
	 *
	 * @return DateTime
	 */
	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}

	/**
	 * Set publishAt
	 *
	 * @param DateTime $publishAt
	 *
	 * @return Page
	 */
	public function setPublishAt($publishAt)
	{
		$this->publishAt = $publishAt;

		return $this;
	}

	/**
	 * Get publishAt
	 *
	 * @return DateTime
	 */
	public function getPublishAt()
	{
		return $this->publishAt;
	}

	/**
	 * Set publishTill
	 *
	 * @param DateTime $publishTill
	 *
	 * @return Page
	 */
	public function setPublishTill($publishTill)
	{
		$this->publishTill = $publishTill;

		return $this;
	}

	/**
	 * Get publishTill
	 *
	 * @return DateTime
	 */
	public function getPublishTill()
	{
		return $this->publishTill;
	}

	/**
	 * Set permalink
	 *
	 * @param string $permalink
	 *
	 * @return Page
	 */
	public function setPermalink($permalink)
	{
		$this->permalink = $permalink;

		return $this;
	}

	/**
	 * Get permalink
	 *
	 * @param bool $getTruePermalink
	 *
	 * @return string|null
	 */
	public function getPermalink($getTruePermalink = false)
	{
		if (false === $getTruePermalink && null !== $this->site && $this->site->getHomepage() === $this) {
			return null;
		}

		return $this->permalink;
	}

	/**
	 * Set true permalink
	 *
	 * @param string $truePermalink
	 *
	 * @return Page
	 */
	public function setTruePermalink($truePermalink)
	{
		$this->permalink = $truePermalink;

		return $this;
	}

	/**
	 * Get true permalink
	 *
	 * @return string
	 */
	public function getTruePermalink()
	{
		return $this->getPermalink(true);
	}

	/**
	 * Set menuTitle
	 *
	 * @param string $menuTitle
	 *
	 * @return Page
	 */
	public function setMenuTitle($menuTitle)
	{
		$this->menuTitle = $menuTitle;

		return $this;
	}

	/**
	 * Get menuTitle
	 *
	 * @return string
	 */
	public function getMenuTitle()
	{
		return $this->menuTitle;
	}

	/**
	 * Set title
	 *
	 * @param string $title
	 *
	 * @return Page
	 */
	public function setTitle($title)
	{
		$this->title = $title;

		return $this;
	}

	/**
	 * Get title
	 *
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Set content
	 *
	 * @param string $content
	 *
	 * @return Page
	 */
	public function setContent($content)
	{
		$this->content = $content;

		return $this;
	}

	/**
	 * Get content
	 *
	 * @return string
	 */
	public function getContent()
	{
		return $this->content;
	}

	/**
	 * Set metaKeywords
	 *
	 * @param string $metaKeywords
	 *
	 * @return Page
	 */
	public function setMetaKeywords($metaKeywords)
	{
		$this->metaKeywords = $metaKeywords;

		return $this;
	}

	/**
	 * Get metaKeywords
	 *
	 * @return string
	 */
	public function getMetaKeywords()
	{
		return $this->metaKeywords;
	}

	/**
	 * Set metaDescription
	 *
	 * @param string $metaDescription
	 *
	 * @return Page
	 */
	public function setMetaDescription($metaDescription)
	{
		$this->metaDescription = $metaDescription;

		return $this;
	}

	/**
	 * Get metaDescription
	 *
	 * @return string
	 */
	public function getMetaDescription()
	{
		return $this->metaDescription;
	}

	/**
	 * Add page
	 *
	 * @param Page $page
	 *
	 * @return Page
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
	 * Add file
	 *
	 * @param File $file
	 *
	 * @return Page
	 */
	public function addFile(File $file)
	{
		$this->files[] = $file;

		return $this;
	}

	/**
	 * Remove file
	 *
	 * @param File $file
	 */
	public function removeFile(File $file)
	{
		$this->files->removeElement($file);
	}

	/**
	 * Get files
	 *
	 * @return Collection
	 */
	public function getFiles()
	{
		return $this->files;
	}

	/**
	 * Set menu
	 *
	 * @param Menu $menu
	 *
	 * @return Page
	 */
	public function setMenu(Menu $menu = null)
	{
		$this->menu = $menu;

		return $this;
	}

	/**
	 * Get menu
	 *
	 * @return Menu
	 */
	public function getMenu()
	{
		return $this->menu;
	}

	/**
	 * Set site
	 *
	 * @param Site $site
	 *
	 * @return Page
	 */
	public function setSite(Site $site = null)
	{
		$this->site = $site;

		return $this;
	}

	/**
	 * Get site
	 *
	 * @return Site
	 */
	public function getSite()
	{
		return $this->site;
	}

	/**
	 * Set createdBy
	 *
	 * @param User $createdBy
	 *
	 * @return Page
	 */
	public function setCreatedBy(User $createdBy = null)
	{
		$this->createdBy = $createdBy;

		return $this;
	}

	/**
	 * Get createdBy
	 *
	 * @return User
	 */
	public function getCreatedBy()
	{
		return $this->createdBy;
	}

	/**
	 * Set updatedBy
	 *
	 * @param User $updatedBy
	 *
	 * @return Page
	 */
	public function setUpdatedBy(User $updatedBy = null)
	{
		$this->updatedBy = $updatedBy;

		return $this;
	}

	/**
	 * Get updatedBy
	 *
	 * @return User
	 */
	public function getUpdatedBy()
	{
		return $this->updatedBy;
	}

	/**
	 * Set pageType
	 *
	 * @param PageType $pageType
	 *
	 * @return Page
	 */
	public function setPageType(PageType $pageType = null)
	{
		$this->pageType = $pageType;

		return $this;
	}

	/**
	 * Get pageType
	 *
	 * @return PageType
	 */
	public function getPageType()
	{
		return $this->pageType;
	}

	/**
	 * Set parent
	 *
	 * @param Page $parent
	 *
	 * @return Page
	 */
	public function setParent(Page $parent = null)
	{
		$this->parent = $parent;

		return $this;
	}

	/**
	 * Get parent
	 *
	 * @return Page
	 */
	public function getParent()
	{
		return $this->parent;
	}

	/**
	 * Add category
	 *
	 * @param Category $category
	 *
	 * @return Page
	 */
	public function addCategory(Category $category)
	{
		$this->categories[] = $category;

		return $this;
	}

	/**
	 * Remove category
	 *
	 * @param Category $category
	 */
	public function removeCategory(Category $category)
	{
		$this->categories->removeElement($category);
	}

	/**
	 * Get categories
	 *
	 * @return Collection
	 */
	public function getCategories()
	{
		return $this->categories;
	}

	/**
	 * Add tag
	 *
	 * @param Tag $tag
	 *
	 * @return Page
	 */
	public function addTag(Tag $tag)
	{
		$this->tags[] = $tag;

		return $this;
	}

	/**
	 * Remove tag
	 *
	 * @param Tag $tag
	 */
	public function removeTag(Tag $tag)
	{
		$this->tags->removeElement($tag);
	}

	/**
	 * Get tags
	 *
	 * @return Collection
	 */
	public function getTags()
	{
		return $this->tags;
	}

	/**
	 * Page title
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->title;
	}

}
