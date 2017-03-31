<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

/**
 * SliderImage interface
 */
interface SliderImageInterface
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
     * @return SliderImageInterface
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
     * @return SliderImageInterface
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
     * @return SliderImageInterface
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
     * @return SliderImageInterface
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
     * @return SliderImageInterface
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
     * @return SliderImageInterface
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
     * @return SliderImageInterface
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
     * @return SliderImageInterface
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
     * @return SliderImageInterface
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
     * @return SliderImageInterface
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
     * @return SliderImageInterface
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
     * @return SliderImageInterface
     */
    public function setLinkId($linkId);

    /**
     * Get linkId
     *
     * @return string
     */
    public function getLinkId();

    /**
     * Set slider
     *
     * @param SliderInterface $slider
     *
     * @return SliderImageInterface
     */
    public function setSlider($slider);

    /**
     * Get slider
     *
     * @return SliderInterface
     */
    public function getSlider();

    /**
     * Set orderId
     *
     * @param integer $orderId
     *
     * @return SliderInterface
     */
    public function setOrderId($orderId);

    /**
     * Get orderId
     *
     * @return integer
     */
    public function getOrderId();

    /**
     * SliderImage name
     *
     * @return string
     */
    public function __toString();
}
