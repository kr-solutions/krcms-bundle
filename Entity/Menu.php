<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Menu
 */
class Menu implements MenuInterface
{

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $pages;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pages = new ArrayCollection();
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
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription()
    {
        return $this->description;
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
