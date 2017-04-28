<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

/**
 * Category
 */
interface CategoryInterface
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
     * @return CategoryInterface
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set imageUri
     *
     * @param string $imageUri
     *
     * @return CategoryInterface
     */
    public function setImageUri($imageUri);

    /**
     * Get imageUri
     *
     * @return string
     */
    public function getImageUri();

    /**
     * Add page
     *
     * @param PageInterface $page
     *
     * @return CategoryInterface
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
     * Category name
     *
     * @return string
     */
    public function __toString();
}
