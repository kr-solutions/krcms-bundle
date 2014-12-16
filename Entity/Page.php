<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


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
	 * @var \DateTime
	 */
	private $createdAt;

	/**
	 * @var \DateTime
	 */
	private $updatedAt;

	/**
	 * @var \DateTime
	 */
	private $publishAt;

	/**
	 * @var \DateTime
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
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $pages;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $files;

	/**
	 * @var \KRSolutions\Bundle\KRCMSBundle\Entity\Menu
	 */
	private $menu;

	/**
	 * @var \KRSolutions\Bundle\KRCMSBundle\Entity\Site
	 */
	private $site;

	/**
	 * @var \KRSolutions\Bundle\KRCMSBundle\Entity\User
	 */
	private $createdBy;

	/**
	 * @var \KRSolutions\Bundle\KRCMSBundle\Entity\User
	 */
	private $updatedBy;

	/**
	 * @var \KRSolutions\Bundle\KRCMSBundle\Entity\PageType
	 */
	private $pageType;

	/**
	 * @var \KRSolutions\Bundle\KRCMSBundle\Entity\Page
	 */
	private $parent;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $categories;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $tags;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->pages = new \Doctrine\Common\Collections\ArrayCollection();
		$this->files = new \Doctrine\Common\Collections\ArrayCollection();
		$this->categories = new \Doctrine\Common\Collections\ArrayCollection();
		$this->tags = new \Doctrine\Common\Collections\ArrayCollection();
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
	 * @param \DateTime $createdAt
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
	 * @return \DateTime
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	/**
	 * Set updatedAt
	 *
	 * @param \DateTime $updatedAt
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
	 * @return \DateTime
	 */
	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}

	/**
	 * Set publishAt
	 *
	 * @param \DateTime $publishAt
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
	 * @return \DateTime
	 */
	public function getPublishAt()
	{
		return $this->publishAt;
	}

	/**
	 * Set publishTill
	 *
	 * @param \DateTime $publishTill
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
	 * @return \DateTime
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
	 * @param \KRSolutions\Bundle\KRCMSBundle\Entity\Page $page
	 *
	 * @return Page
	 */
	public function addPage(\KRSolutions\Bundle\KRCMSBundle\Entity\Page $page)
	{
		$this->pages[] = $page;

		return $this;
	}

	/**
	 * Remove page
	 *
	 * @param \KRSolutions\Bundle\KRCMSBundle\Entity\Page $page
	 */
	public function removePage(\KRSolutions\Bundle\KRCMSBundle\Entity\Page $page)
	{
		$this->pages->removeElement($page);
	}

	/**
	 * Get pages
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getPages()
	{
		return $this->pages;
	}

	/**
	 * Add file
	 *
	 * @param \KRSolutions\Bundle\KRCMSBundle\Entity\File $file
	 *
	 * @return Page
	 */
	public function addFile(\KRSolutions\Bundle\KRCMSBundle\Entity\File $file)
	{
		$this->files[] = $file;

		return $this;
	}

	/**
	 * Remove file
	 *
	 * @param \KRSolutions\Bundle\KRCMSBundle\Entity\File $file
	 */
	public function removeFile(\KRSolutions\Bundle\KRCMSBundle\Entity\File $file)
	{
		$this->files->removeElement($file);
	}

	/**
	 * Get files
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getFiles()
	{
		return $this->files;
	}

	/**
	 * Set menu
	 *
	 * @param \KRSolutions\Bundle\KRCMSBundle\Entity\Menu $menu
	 *
	 * @return Page
	 */
	public function setMenu(\KRSolutions\Bundle\KRCMSBundle\Entity\Menu $menu = null)
	{
		$this->menu = $menu;

		return $this;
	}

	/**
	 * Get menu
	 *
	 * @return \KRSolutions\Bundle\KRCMSBundle\Entity\Menu
	 */
	public function getMenu()
	{
		return $this->menu;
	}

	/**
	 * Set site
	 *
	 * @param \KRSolutions\Bundle\KRCMSBundle\Entity\Site $site
	 *
	 * @return Page
	 */
	public function setSite(\KRSolutions\Bundle\KRCMSBundle\Entity\Site $site = null)
	{
		$this->site = $site;

		return $this;
	}

	/**
	 * Get site
	 *
	 * @return \KRSolutions\Bundle\KRCMSBundle\Entity\Site
	 */
	public function getSite()
	{
		return $this->site;
	}

	/**
	 * Set createdBy
	 *
	 * @param \KRSolutions\Bundle\KRCMSBundle\Entity\User $createdBy
	 *
	 * @return Page
	 */
	public function setCreatedBy(\KRSolutions\Bundle\KRCMSBundle\Entity\User $createdBy = null)
	{
		$this->createdBy = $createdBy;

		return $this;
	}

	/**
	 * Get createdBy
	 *
	 * @return \KRSolutions\Bundle\KRCMSBundle\Entity\User
	 */
	public function getCreatedBy()
	{
		return $this->createdBy;
	}

	/**
	 * Set updatedBy
	 *
	 * @param \KRSolutions\Bundle\KRCMSBundle\Entity\User $updatedBy
	 *
	 * @return Page
	 */
	public function setUpdatedBy(\KRSolutions\Bundle\KRCMSBundle\Entity\User $updatedBy = null)
	{
		$this->updatedBy = $updatedBy;

		return $this;
	}

	/**
	 * Get updatedBy
	 *
	 * @return \KRSolutions\Bundle\KRCMSBundle\Entity\User
	 */
	public function getUpdatedBy()
	{
		return $this->updatedBy;
	}

	/**
	 * Set pageType
	 *
	 * @param \KRSolutions\Bundle\KRCMSBundle\Entity\PageType $pageType
	 *
	 * @return Page
	 */
	public function setPageType(\KRSolutions\Bundle\KRCMSBundle\Entity\PageType $pageType = null)
	{
		$this->pageType = $pageType;

		return $this;
	}

	/**
	 * Get pageType
	 *
	 * @return \KRSolutions\Bundle\KRCMSBundle\Entity\PageType
	 */
	public function getPageType()
	{
		return $this->pageType;
	}

	/**
	 * Set parent
	 *
	 * @param \KRSolutions\Bundle\KRCMSBundle\Entity\Page $parent
	 *
	 * @return Page
	 */
	public function setParent(\KRSolutions\Bundle\KRCMSBundle\Entity\Page $parent = null)
	{
		$this->parent = $parent;

		return $this;
	}

	/**
	 * Get parent
	 *
	 * @return \KRSolutions\Bundle\KRCMSBundle\Entity\Page
	 */
	public function getParent()
	{
		return $this->parent;
	}

	/**
	 * Add category
	 *
	 * @param \KRSolutions\Bundle\KRCMSBundle\Entity\Category $category
	 *
	 * @return Page
	 */
	public function addCategory(\KRSolutions\Bundle\KRCMSBundle\Entity\Category $category)
	{
		$this->categories[] = $category;

		return $this;
	}

	/**
	 * Remove category
	 *
	 * @param \KRSolutions\Bundle\KRCMSBundle\Entity\Category $category
	 */
	public function removeCategory(\KRSolutions\Bundle\KRCMSBundle\Entity\Category $category)
	{
		$this->categories->removeElement($category);
	}

	/**
	 * Get categories
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getCategories()
	{
		return $this->categories;
	}

	/**
	 * Add tag
	 *
	 * @param \KRSolutions\Bundle\KRCMSBundle\Entity\Tag $tag
	 *
	 * @return Page
	 */
	public function addTag(\KRSolutions\Bundle\KRCMSBundle\Entity\Tag $tag)
	{
		$this->tags[] = $tag;

		return $this;
	}

	/**
	 * Remove tag
	 *
	 * @param \KRSolutions\Bundle\KRCMSBundle\Entity\Tag $tag
	 */
	public function removeTag(\KRSolutions\Bundle\KRCMSBundle\Entity\Tag $tag)
	{
		$this->tags->removeElement($tag);
	}

	/**
	 * Get tags
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getTags()
	{
		return $this->tags;
	}

	/**
	 * Page to string
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->title;
	}

}
