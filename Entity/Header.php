<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

/**
 * Header
 */
class Header implements HeaderInterface
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $subtitle;

    /**
     * @var int
     */
    private $linkType;

    /**
     * @var \stdClass
     */
    private $linkPage;

    /**
     * @var string
     */
    private $linkHref;

    /**
     * @var string
     */
    private $linkTarget;

    /**
     * @var string
     */
    private $linkLabel;

    /**
     * @var string
     */
    private $linkTitle;

    /**
     * @var string
     */
    private $linkClass;

    /**
     * @var string
     */
    private $linkId;

    /**
     * Get id
     *
     * @return int
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
     * @return Header
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
     * Set uri
     *
     * @param string $uri
     *
     * @return Header
     */
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * Get uri
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Header
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
     * Set subtitle
     *
     * @param string $subtitle
     *
     * @return Header
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set linkType
     *
     * @param integer $linkType
     *
     * @return Header
     */
    public function setLinkType($linkType)
    {
        $this->linkType = $linkType;

        return $this;
    }

    /**
     * Get linkType
     *
     * @return int
     */
    public function getLinkType()
    {
        return $this->linkType;
    }

    /**
     * Set linkPage
     *
     * @param \stdClass $linkPage
     *
     * @return Header
     */
    public function setLinkPage($linkPage)
    {
        $this->linkPage = $linkPage;

        return $this;
    }

    /**
     * Get linkPage
     *
     * @return \stdClass
     */
    public function getLinkPage()
    {
        return $this->linkPage;
    }

    /**
     * Set linkHref
     *
     * @param string $linkHref
     *
     * @return Header
     */
    public function setLinkHref($linkHref)
    {
        $this->linkHref = $linkHref;

        return $this;
    }

    /**
     * Get linkHref
     *
     * @return string
     */
    public function getLinkHref()
    {
        return $this->linkHref;
    }

    /**
     * Set linkTarget
     *
     * @param string $linkTarget
     *
     * @return Header
     */
    public function setLinkTarget($linkTarget)
    {
        $this->linkTarget = $linkTarget;

        return $this;
    }

    /**
     * Get linkTarget
     *
     * @return string
     */
    public function getLinkTarget()
    {
        return $this->linkTarget;
    }

    /**
     * Set linkLabel
     *
     * @param string $linkLabel
     *
     * @return Header
     */
    public function setLinkLabel($linkLabel)
    {
        $this->linkLabel = $linkLabel;

        return $this;
    }

    /**
     * Get linkLabel
     *
     * @return string
     */
    public function getLinkLabel()
    {
        return $this->linkLabel;
    }

    /**
     * Set linkTitle
     *
     * @param string $linkTitle
     *
     * @return Header
     */
    public function setLinkTitle($linkTitle)
    {
        $this->linkTitle = $linkTitle;

        return $this;
    }

    /**
     * Get linkTitle
     *
     * @return string
     */
    public function getLinkTitle()
    {
        return $this->linkTitle;
    }

    /**
     * Set linkClass
     *
     * @param string $linkClass
     *
     * @return Header
     */
    public function setLinkClass($linkClass)
    {
        $this->linkClass = $linkClass;

        return $this;
    }

    /**
     * Get linkClass
     *
     * @return string
     */
    public function getLinkClass()
    {
        return $this->linkClass;
    }

    /**
     * Set linkId
     *
     * @param string $linkId
     *
     * @return Header
     */
    public function setLinkId($linkId)
    {
        $this->linkId = $linkId;

        return $this;
    }

    /**
     * Get linkId
     *
     * @return string
     */
    public function getLinkId()
    {
        return $this->linkId;
    }
}
