<?php

namespace KRSolutions\Bundle\KRCMSBundle\Model;

use Doctrine\ORM\QueryBuilder;
use KRSolutions\Bundle\KRCMSBundle\Entity\SliderInterface;

/**
 * Slider manager interface
 */
interface SliderManagerInterface
{

    /**
     * Create a new slider
     *
     * @return SliderInterface
     */
    public function createSlider();

    /**
     * Returns the slider's fully qualified class name.
     *
     * @return string
     */
    public function getClass();

    /**
     * Get all slider's
     *
     * @return array
     */
    public function findAll();

    /**
     * Get all Sliders
     *
     * @return array
     */
    public function getAllSliders();

    /**
     * Get Sliders Entity by id
     *
     * @param integer $sliderId
     *
     * @return SliderInterface
     */
    public function getSliderById($sliderId);

    /**
     * Get Sliders Entity by name
     *
     * @param string $sliderName
     *
     * @return SliderInterface
     */
    public function getSliderByName($sliderName);

    /**
     * Get Sliders QB
     *
     * @return QueryBuilder
     */
    public function getSlidersQB();
}
