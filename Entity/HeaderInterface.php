<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

/**
 * Header interface
 */
interface HeaderInterface
{

    /**
     * Get id
     *
     * @return int
     */
    public function getId();

    /**
     * Set name
     *
     * @param string $name
     *
     * @return HeaderInterface
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set uri
     *
     * @param string $uri
     *
     * @return HeaderInterface
     */
    public function setUri($uri);

    /**
     * Get uri
     *
     * @return string
     */
    public function getUri();

    /**
     * Set title
     *
     * @param string $title
     *
     * @return HeaderInterface
     */
    public function setTitle($title);

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set subtitle
     *
     * @param string $subtitle
     *
     * @return HeaderInterface
     */
    public function setSubtitle($subtitle);

    /**
     * Get subtitle
     *
     * @return string
     */
    public function getSubtitle();

    /**
     * Set linkType
     *
     * @param integer $linkType
     *
     * @return HeaderInterface
     */
    public function setLinkType($linkType);

    /**
     * Get linkType
     *
     * @return int
     */
    public function getLinkType();

    /**
     * Set linkPage
     *
     * @param PageInterface $linkPage
     *
     * @return HeaderInterface
     */
    public function setLinkPage($linkPage);

    /**
     * Get linkPage
     *
     * @return PageInterface
     */
    public function getLinkPage();

    /**
     * Set linkHref
     *
     * @param string $linkHref
     *
     * @return HeaderInterface
     */
    public function setLinkHref($linkHref);

    /**
     * Get linkHref
     *
     * @return string
     */
    public function getLinkHref();

    /**
     * Set linkTarget
     *
     * @param string $linkTarget
     *
     * @return HeaderInterface
     */
    public function setLinkTarget($linkTarget);

    /**
     * Get linkTarget
     *
     * @return string
     */
    public function getLinkTarget();

    /**
     * Set linkLabel
     *
     * @param string $linkLabel
     *
     * @return HeaderInterface
     */
    public function setLinkLabel($linkLabel);

    /**
     * Get linkLabel
     *
     * @return string
     */
    public function getLinkLabel();

    /**
     * Set linkTitle
     *
     * @param string $linkTitle
     *
     * @return HeaderInterface
     */
    public function setLinkTitle($linkTitle);

    /**
     * Get linkTitle
     *
     * @return string
     */
    public function getLinkTitle();

    /**
     * Set linkClass
     *
     * @param string $linkClass
     *
     * @return HeaderInterface
     */
    public function setLinkClass($linkClass);

    /**
     * Get linkClass
     *
     * @return string
     */
    public function getLinkClass();

    /**
     * Set linkId
     *
     * @param string $linkId
     *
     * @return HeaderInterface
     */
    public function setLinkId($linkId);

    /**
     * Get linkId
     *
     * @return string
     */
    public function getLinkId();

    /**
     * Add page
     *
     * @param PageInterface $page
     *
     * @return HeaderInterface
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
     * Header name
     *
     * @return string
     */
    public function __toString();
}
