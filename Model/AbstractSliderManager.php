<?php

namespace KRSolutions\Bundle\KRCMSBundle\Model;

/**
 * Abstract slider manager
 */
abstract class AbstractSliderManager implements SliderManagerInterface
{

    /**
     * Constructor
     */
    public function __construct()
    {

    }

    /**
     * {@inheritDoc}
     */
    public function createSlider()
    {
        $class = $this->getClass();
        $slider = new $class;

        return $slider;
    }
}
