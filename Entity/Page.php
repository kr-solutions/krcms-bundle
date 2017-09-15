<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Page
 */
class Page implements PageInterface
{

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var integer
     */
    protected $orderId;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     */
    protected $publishAt;

    /**
     * @var \DateTime
     */
    protected $publishTill;

    /**
     * @var string
     */
    protected $permalink;

    /**
     * @var string
     */
    protected $menuTitle;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $metaKeywords;

    /**
     * @var string
     */
    protected $metaDescription;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $pages;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $files;

    /**
     * @var MenuInterface
     */
    protected $menu;

    /**
     * @var SliderInterface
     */
    protected $slider;

    /**
     * @var HeaderInterface
     */
    protected $header;

    /**
     * @var CategoryInterface
     */
    protected $category;

    /**
     * @var \Symfony\Component\Security\Core\User\UserInterface
     */
    protected $createdBy;

    /**
     * @var \Symfony\Component\Security\Core\User\UserInterface
     */
    protected $updatedBy;

    /**
     * @var PageTypeInterface
     */
    protected $pageType;

    /**
     * @var PageInterface
     */
    protected $parent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $tags;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pages = new ArrayCollection();
        $this->files = new ArrayCollection();
        $this->tags = new ArrayCollection();

        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
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
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritDoc}
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * {@inheritDoc}
     */
    public function setPublishAt(\DateTime $publishAt)
    {
        $this->publishAt = $publishAt;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getPublishAt()
    {
        return $this->publishAt;
    }

    /**
     * {@inheritDoc}
     */
    public function setPublishTill(\DateTime $publishTill = null)
    {
        $this->publishTill = $publishTill;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getPublishTill()
    {
        return $this->publishTill;
    }

    /**
     * {@inheritDoc}
     */
    public function setPermalink($permalink)
    {
        $this->permalink = $permalink;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getPermalink()
    {
        return $this->permalink;
    }

    /**
     * {@inheritDoc}
     */
    public function setMenuTitle($menuTitle)
    {
        $this->menuTitle = $menuTitle;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getMenuTitle()
    {
        return $this->menuTitle;
    }

    /**
     * {@inheritDoc}
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * {@inheritDoc}
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * {@inheritDoc}
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * {@inheritDoc}
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * {@inheritDoc}
     */
    public function addPage(PageInterface $page)
    {
        $this->pages[] = $page;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removePage(PageInterface $page)
    {
        $this->pages->removeElement($page);
    }

    /**
     * {@inheritDoc}
     */
    public function getPages()
    {
        $pages = $this->pages->toArray();

        if (isset($this->pageType)) {
            $orderBy = $this->pageType->getChildrenOrderBy();
            $orderDirection = $this->pageType->getChildrenOrderDirection();

            switch ($orderBy) {
                case 'createdAt':
                    usort($pages, function ($item1, $item2) use ($orderDirection) {
                        if ($item1->getCreatedAt() == $item2->getCreatedAt()) {
                            return 0;
                        }
                        if ($orderDirection === 'asc') {
                            return $item1->getCreatedAt() < $item2->getCreatedAt() ? -1 : 1;
                        } else {
                            return $item1->getCreatedAt() > $item2->getCreatedAt() ? -1 : 1;
                        }
                    });
                    break;
                default:
                    die();
                    break;
            }
        }

        return $pages;
    }

    /**
     * {@inheritDoc}
     */
    public function addFile(FileInterface $file)
    {
        $this->files[] = $file;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removeFile(FileInterface $file)
    {
        $this->files->removeElement($file);
    }

    /**
     * {@inheritDoc}
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * {@inheritDoc}
     */
    public function setMenu(MenuInterface $menu = null)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * {@inheritDoc}
     */
    public function getSlider()
    {
        return $this->slider;
    }

    /**
     * {@inheritDoc}
     */
    public function setSlider(SliderInterface $slider = null)
    {
        $this->slider = $slider;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setHeader(HeaderInterface $header = null)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * {@inheritDoc}
     */
    public function setCategory(CategoryInterface $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCategory()
    {
        return $this->header;
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedBy(\Symfony\Component\Security\Core\User\UserInterface $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * {@inheritDoc}
     */
    public function setUpdatedBy(\Symfony\Component\Security\Core\User\UserInterface $updatedBy = null)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * {@inheritDoc}
     */
    public function setPageType(PageTypeInterface $pageType = null)
    {
        $this->pageType = $pageType;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getPageType()
    {
        return $this->pageType;
    }

    /**
     * {@inheritDoc}
     */
    public function setParent(PageInterface $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * {@inheritDoc}
     */
    public function addTag(TagInterface $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removeTag(TagInterface $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * {@inheritDoc}
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return $this->title;
    }
}
