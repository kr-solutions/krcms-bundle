<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Slider
 */
class Slider implements SliderInterface
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
     * @var bool
     */
    protected $isDefault;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $pages;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $sliderImages;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pages = new ArrayCollection();
        $this->sliderImages = new ArrayCollection();
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
    public function getIsDefault()
    {
        return $this->isDefault;
    }

    /**
     * {@inheritDoc}
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;

        return $this;
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
    public function addSliderImage(SliderImageInterface $sliderImage)
    {
        $this->sliderImages[] = $sliderImage;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removeSliderImage(SliderImageInterface $sliderImage)
    {
        $this->sliderImages->removeElement($sliderImage);
    }

    /**
     * {@inheritDoc}
     */
    public function getSliderImages()
    {
        return $this->sliderImages;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return $this->name;
    }
}
