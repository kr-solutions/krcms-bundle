<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

/**
 * Page interface
 */
interface PageInterface
{

    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set orderId
     *
     * @param integer $orderId
     *
     * @return PageInterface
     */
    public function setOrderId($orderId);

    /**
     * Get orderId
     *
     * @return integer
     */
    public function getOrderId();

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return PageInterface
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return PageInterface
     */
    public function setUpdatedAt(\DateTime$updatedAt);

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * Set publishAt
     *
     * @param \DateTime $publishAt
     *
     * @return PageInterface
     */
    public function setPublishAt(\DateTime $publishAt);

    /**
     * Get publishAt
     *
     * @return \DateTime
     */
    public function getPublishAt();

    /**
     * Set publishTill
     *
     * @param \DateTime $publishTill
     *
     * @return PageInterface
     */
    public function setPublishTill(\DateTime $publishTill = null);

    /**
     * Get publishTill
     *
     * @return \DateTime
     */
    public function getPublishTill();

    /**
     * Set permalink
     *
     * @param string $permalink
     *
     * @return PageInterface
     */
    public function setPermalink($permalink);

    /**
     * Get permalink
     *
     * @return string|null
     */
    public function getPermalink();

    /**
     * Set menuTitle
     *
     * @param string $menuTitle
     *
     * @return PageInterface
     */
    public function setMenuTitle($menuTitle);

    /**
     * Get menuTitle
     *
     * @return string
     */
    public function getMenuTitle();

    /**
     * Set title
     *
     * @param string $title
     *
     * @return PageInterface
     */
    public function setTitle($title);

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set content
     *
     * @param string $content
     *
     * @return PageInterface
     */
    public function setContent($content);

    /**
     * Get content
     *
     * @return string
     */
    public function getContent();

    /**
     * Set metaKeywords
     *
     * @param string $metaKeywords
     *
     * @return PageInterface
     */
    public function setMetaKeywords($metaKeywords);

    /**
     * Get metaKeywords
     *
     * @return string
     */
    public function getMetaKeywords();

    /**
     * Set metaDescription
     *
     * @param string $metaDescription
     *
     * @return PageInterface
     */
    public function setMetaDescription($metaDescription);

    /**
     * Get metaDescription
     *
     * @return string
     */
    public function getMetaDescription();

    /**
     * Add page
     *
     * @param PageInterface $page
     *
     * @return PageInterface
     */
    public function addPage(PageInterface $page);

    /**
     * Remove page
     *
     * @param PageInterface $page
     */
    public function removePage(PageInterface $page);

    /**
     * Get pages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPages();

    /**
     * Add file
     *
     * @param FileInterface $file
     *
     * @return PageInterface
     */
    public function addFile(FileInterface $file);

    /**
     * Remove file
     *
     * @param FileInterface $file
     */
    public function removeFile(FileInterface $file);

    /**
     * Get files
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFiles();

    /**
     * Set menu
     *
     * @param MenuInterface $menu
     *
     * @return PageInterface
     */
    public function setMenu(MenuInterface $menu = null);

    /**
     * Get menu
     *
     * @return MenuInterface
     */
    public function getMenu();

    /**
     * Set slider
     *
     * @param SliderInterface $slider
     *
     * @return PageInterface
     */
    public function setSlider(SliderInterface $slider = null);

    /**
     * Get slider
     *
     * @return SliderInterface
     */
    public function getSlider();

    /**
     * Set header
     *
     * @param HeaderInterface $header
     *
     * @return PageInterface
     */
    public function setHeader(HeaderInterface $header = null);

    /**
     * Get header
     *
     * @return HeaderInterface
     */
    public function getHeader();

    /**
     * Set createdBy
     *
     * @param \Symfony\Component\Security\Core\User\UserInterface $createdBy
     *
     * @return PageInterface
     */
    public function setCreatedBy(\Symfony\Component\Security\Core\User\UserInterface $createdBy = null);

    /**
     * Get createdBy
     *
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function getCreatedBy();

    /**
     * Set updatedBy
     *
     * @param \Symfony\Component\Security\Core\User\UserInterface $updatedBy
     *
     * @return PageInterface
     */
    public function setUpdatedBy(\Symfony\Component\Security\Core\User\UserInterface $updatedBy = null);

    /**
     * Get updatedBy
     *
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function getUpdatedBy();

    /**
     * Set pageType
     *
     * @param PageTypeInterface $pageType
     *
     * @return PageInterface
     */
    public function setPageType(PageTypeInterface $pageType = null);

    /**
     * Get pageType
     *
     * @return PageTypeInterface
     */
    public function getPageType();

    /**
     * Set parent
     *
     * @param PageInterface $parent
     *
     * @return PageInterface
     */
    public function setParent(PageInterface $parent = null);

    /**
     * Get parent
     *
     * @return PageInterface
     */
    public function getParent();

    /**
     * Add category
     *
     * @param CategoryInterface $category
     *
     * @return PageInterface
     */
    public function addCategory(CategoryInterface $category);

    /**
     * Remove category
     *
     * @param CategoryInterface $category
     */
    public function removeCategory(CategoryInterface $category);

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories();

    /**
     * Add tag
     *
     * @param TagInterface $tag
     *
     * @return PageInterface
     */
    public function addTag(TagInterface $tag);

    /**
     * Remove tag
     *
     * @param TagInterface $tag
     */
    public function removeTag(TagInterface $tag);

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags();

    /**
     * Page title
     *
     * @return string
     */
    public function __toString();
}
