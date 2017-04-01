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
    protected $id;

    /**
     * @var string
     */
    protected $uri;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $subtitle;

    /**
     * @var int
     */
    protected $linkType;

    /**
     * @var PageInterface
     */
    protected $linkPage;

    /**
     * @var string
     */
    protected $linkHref;

    /**
     * @var string
     */
    protected $linkTarget;

    /**
     * @var string
     */
    protected $linkLabel;

    /**
     * @var string
     */
    protected $linkTitle;

    /**
     * @var string
     */
    protected $linkClass;

    /**
     * @var string
     */
    protected $linkId;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $pages;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pages = new \Doctrine\Common\Collections\ArrayCollection();
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
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getUri()
    {
        return $this->uri;
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
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * {@inheritDoc}
     */
    public function setLinkType($linkType)
    {
        $this->linkType = $linkType;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getLinkType()
    {
        return $this->linkType;
    }

    /**
     * {@inheritDoc}
     */
    public function setLinkPage($linkPage)
    {
        $this->linkPage = $linkPage;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getLinkPage()
    {
        return $this->linkPage;
    }

    /**
     * {@inheritDoc}
     */
    public function setLinkHref($linkHref)
    {
        $this->linkHref = $linkHref;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getLinkHref()
    {
        return $this->linkHref;
    }

    /**
     * {@inheritDoc}
     */
    public function setLinkTarget($linkTarget)
    {
        $this->linkTarget = $linkTarget;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getLinkTarget()
    {
        return $this->linkTarget;
    }

    /**
     * {@inheritDoc}
     */
    public function setLinkLabel($linkLabel)
    {
        $this->linkLabel = $linkLabel;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getLinkLabel()
    {
        return $this->linkLabel;
    }

    /**
     * {@inheritDoc}
     */
    public function setLinkTitle($linkTitle)
    {
        $this->linkTitle = $linkTitle;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getLinkTitle()
    {
        return $this->linkTitle;
    }

    /**
     * {@inheritDoc}
     */
    public function setLinkClass($linkClass)
    {
        $this->linkClass = $linkClass;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getLinkClass()
    {
        return $this->linkClass;
    }

    /**
     * {@inheritDoc}
     */
    public function setLinkId($linkId)
    {
        $this->linkId = $linkId;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getLinkId()
    {
        return $this->linkId;
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
        return $this->pages;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return $this->name;
    }
}
