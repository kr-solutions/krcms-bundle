<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

/**
 * Menu interface
 */
interface MenuInterface
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
     * @return MenuInterface
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
     * @return MenuInterface
     */
    public function setDescription($description);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Add page
     *
     * @param PageInterface $page
     *
     * @return MenuInterface
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
     * Menu name
     *
     * @return string
     */
    public function __toString();
}
