<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

/**
 * Language interface
 */
interface LanguageInterface
{

    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set country
     *
     * @param string $country
     *
     * @return LanguageInterface
     */
    public function setCountry($country);

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry();

    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return LanguageInterface
     */
    public function setLocale($locale);

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale();

    /**
     * Locale name
     *
     * @return string
     */
    public function __toString();
}
