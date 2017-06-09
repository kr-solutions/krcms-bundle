<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

/**
 * Slider interface
 */
interface SliderInterface
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
     * @return SliderInterface
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
     * @return SliderInterface
     */
    public function setDescription($description);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set isDefault
     *
     * @param bool $isDefault
     *
     * @return SliderInterface
     */
    public function setIsDefault($isDefault);

    /**
     * Get isDefault
     *
     * @return bool
     */
    public function getIsDefault();

    /**
     * Add page
     *
     * @param PageInterface $page
     *
     * @return SliderInterface
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
     * Add sliderImage
     *
     * @param SliderImageInterface $sliderImage
     *
     * @return SliderInterface
     */
    public function addSliderImage(SliderImageInterface $sliderImage);

    /**
     * Remove sliderImage
     *
     * @param SliderImageInterface $sliderImage
     */
    public function removeSliderImage(SliderImageInterface $sliderImage);

    /**
     * Get sliderImages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSliderImages();

    /**
     * Slider name
     *
     * @return string
     */
    public function __toString();
}
