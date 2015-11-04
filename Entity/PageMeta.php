<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

/**
 * PageMeta
 */
class PageMeta implements PageMetaInterface
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $metaKey;

    /**
     * @var string
     */
    private $metaValue;

    /**
     * @var PageInterface
     */
    private $page;

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
    public function setMetaKey($metaKey)
    {
        $this->metaKey = $metaKey;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getMetaKey()
    {
        return $this->metaKey;
    }

    /**
     * {@inheritDoc}
     */
    public function setMetaValue($metaValue)
    {
        $this->metaValue = $metaValue;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getMetaValue()
    {
        return $this->metaValue;
    }

    /**
     * {@inheritDoc}
     */
    public function setPage(PageInterface $page = null)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return $this->metaKey;
    }
}
