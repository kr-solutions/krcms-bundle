<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

/**
 * Language
 */
class Language implements LanguageInterface
{

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var string
     */
    protected $locale;

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
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * {@inheritDoc}
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return $this->locale;
    }
}
